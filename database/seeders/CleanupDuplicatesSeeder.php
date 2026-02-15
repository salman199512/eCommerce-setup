<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CleanupDuplicatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \Illuminate\Support\Facades\DB::transaction(function () {
            // 1. Merge Attribute Groups
            $groups = \App\Models\AttributeGroup::all()->groupBy(fn($g) => strtolower(trim($g->title)));

            foreach ($groups as $title => $duplicates) {
                if ($duplicates->count() > 1) {
                    $primary = $duplicates->sortBy('id')->first();
                    $others = $duplicates->where('id', '!=', $primary->id);

                    foreach ($others as $other) {
                        // Move attributes to primary group
                        $otherAttributes = \App\Models\Attribute::where('attribute_group_id', $other->id)->get();
                        foreach ($otherAttributes as $otherAttr) {
                            // Check if an attribute with same name exists in primary group
                            $primaryAttr = \App\Models\Attribute::where('attribute_group_id', $primary->id)
                                ->where('title', $otherAttr->title)
                                ->first();

                            if ($primaryAttr) {
                                // Merge pivot associations
                                \Illuminate\Support\Facades\DB::table('product_attributes')
                                    ->where('attribute_id', $otherAttr->id)
                                    ->update([
                                        'attribute_id' => $primaryAttr->id,
                                        'attribute_group_id' => $primary->id
                                    ]);

                                \Illuminate\Support\Facades\DB::table('product_variant_attributes')
                                    ->where('attribute_id', $otherAttr->id)
                                    ->update([
                                        'attribute_id' => $primaryAttr->id,
                                        'attribute_group_id' => $primary->id
                                    ]);

                                $otherAttr->delete();
                            } else {
                                // Just move the attribute to the primary group
                                $otherAttr->update(['attribute_group_id' => $primary->id]);
                            }
                        }
                        $other->delete();
                    }
                }
            }

            // 2. Cleanup duplicate associations in pivot tables (just in case)
            $this->cleanupPivot('product_attributes', ['product_id', 'attribute_group_id', 'attribute_id']);
            $this->cleanupPivot('product_variant_attributes', ['product_variant_id', 'attribute_group_id', 'attribute_id']);
        });
    }

    private function cleanupPivot($table, $columns)
    {
        $duplicates = \Illuminate\Support\Facades\DB::table($table)
            ->select($columns)
            ->selectRaw('count(*) as count')
            ->groupBy($columns)
            ->having('count', '>', 1)
            ->get();

        foreach ($duplicates as $duplicate) {
            $query = \Illuminate\Support\Facades\DB::table($table);
            foreach ($columns as $column) {
                $query->where($column, $duplicate->$column);
            }
            
            // Keep the first one, delete the rest
            $ids = $query->pluck('id');
            if ($ids->count() > 1) {
                $toDelete = $ids->slice(1);
                \Illuminate\Support\Facades\DB::table($table)->whereIn('id', $toDelete)->delete();
            }
        }
    }
}
