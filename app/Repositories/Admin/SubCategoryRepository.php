<?php

namespace App\Repositories\Admin;

use App\Models\SubCategory;
use App\Repositories\BaseRepository;
use Illuminate\Http\Request;

class SubCategoryRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'category_id',
        'title',
        'status',
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return SubCategory::class;
    }

    /**
     * request handler for store and update
     * @param Request $request
     * @return array
     */
    public static function requestHandler(Request $request) {
        return [
            'category_id' => $request->category_id,
            'title' => $request->title,
            'status' => $request->has('status') ? 1 : 0,
        ];
    }
}
