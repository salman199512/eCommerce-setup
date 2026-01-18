<?php

namespace App\Repositories\Admin;

use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductVariant;
use App\Models\ProductVariantAttribute;
use App\Repositories\BaseRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ProductRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'title',
        'status',
        'category_id',
        'sub_category_id',
        'brand_id',
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Product::class;
    }

    public function create($input)
    {
        return DB::transaction(function () use ($input) {
            $product = parent::create($input);

            // Sync Product Attributes (Pivot)
            if (isset($input['attributes']) && is_array($input['attributes'])) {
                foreach ($input['attributes'] as $group_id => $attribute_ids) {
                    foreach ($attribute_ids as $attribute_id) {
                        ProductAttribute::create([
                            'product_id' => $product->id,
                            'attribute_group_id' => $group_id,
                            'attribute_id' => $attribute_id,
                        ]);
                    }
                }
            }

            // Create Variants
            if (isset($input['variants']) && is_array($input['variants'])) {
                foreach ($input['variants'] as $variantData) {
                    $variant = ProductVariant::create([
                        'product_id' => $product->id,
                        'price' => $variantData['price'],
                        'discount' => $variantData['discount'],
                        'final_price' => $variantData['price'] - ($variantData['price'] * ($variantData['discount'] / 100)), // Simplified logic
                        'sku' => $variantData['sku'] ?? null,
                    ]);

                    // Attach Attributes to Variant
                    if (isset($variantData['attributes']) && is_array($variantData['attributes'])) {
                        foreach ($variantData['attributes'] as $attr) {
                             ProductVariantAttribute::create([
                                'product_variant_id' => $variant->id,
                                'attribute_group_id' => $attr['group_id'],
                                'attribute_id' => $attr['attribute_id'],
                            ]);
                        }
                    }
                }
            }

            // Handle Media
            if (isset($input['product_images']) && !empty($input['product_images'])) {
                 $product->addMediaFromRequest('product_images')->toMediaCollection('product_images');
            }
             // For multiple images if passed as array of temp files or handled via separate endpoint,
             // typically we check for specific input names. Assuming standard Spatie handling or custom logic akin to user avatar.
             // If using the multi-image dropzone which sends a list of UUIDs or hidden inputs:
             if(request()->has('product_images')){
                 // Implementation depends on how the multi-image dropzone sends data.
                 // Usually it might be handled by the controller's media handler trait or manually here.
                 // For now, leaving as placeholder for standard single/multi file logic.
             }

            return $product;
        });
    }

    public function update($input, $id)
    {

        return DB::transaction(function () use ($input, $id) {
            $product = parent::update($input, $id);

            // Sync Product Attributes - Delete old and recreate for simplicity or use sync logic
            ProductAttribute::where('product_id', $product->id)->delete();
            if (isset($input['attributes']) && is_array($input['attributes'])) {
                 foreach ($input['attributes'] as $group_id => $attribute_ids) {
                    foreach ($attribute_ids as $attribute_id) {
                        ProductAttribute::create([
                            'product_id' => $product->id,
                            'attribute_group_id' => $group_id,
                            'attribute_id' => $attribute_id,
                        ]);
                    }
                }
            }

            // Sync Variants - Strategy: Delete all and recreate OR update existing.
            // Recreating is safer for maintaining integrity with combinations unless we track variant IDs in UI.
            // For MVP, we will delete all previous variants and recreate based on current form state.
            $product->variants()->delete();
            // Note: Soft delete might be better if we want to keep order history, but for now hard delete variants or soft delete them.
            // If using soft deletes on variants, we should force delete or restore if identical exists.

            if (isset($input['variants']) && is_array($input['variants'])) {
                 foreach ($input['variants'] as $variantData) {
                    $variant = ProductVariant::create([
                        'product_id' => $product->id,
                        'price' => $variantData['price'],
                        'discount' => $variantData['discount'],
                        'final_price' => $variantData['price'] - ($variantData['price'] * ($variantData['discount'] / 100)),
                        'sku' => $variantData['sku'] ?? null,
                    ]);

                     if (isset($variantData['attributes']) && is_array($variantData['attributes'])) {
                        foreach ($variantData['attributes'] as $attr) {
                             ProductVariantAttribute::create([
                                'product_variant_id' => $variant->id,
                                'attribute_group_id' => $attr['group_id'],
                                'attribute_id' => $attr['id'],
                            ]);
                        }
                    }
                }
            }

            if (isset($input['images']) && !empty($input['images'])) {
                $defaultMedia = 'https://ui-avatars.com/api/?' . http_build_query(['name' => $product->id, 'size' => '500']);
                $uploadedMediaUuids = $input['images'];

                if (!empty($uploadedMediaUuids)) {
                    foreach ($uploadedMediaUuids as $uploadedMediaUuid) {
                        $uploadedMedia = Media::findByUuid($uploadedMediaUuid);
                        if (!empty($uploadedMedia)) {
                            $copiedMedia = $uploadedMedia->move($product, 'product_images');
                        }
                    }
                }

            }

            return $product;
        });
    }

    /**
     * request handler for store and update
     * @param Request $request
     * @return array
     */
    public static function requestHandler(Request $request) {
        $data = [
            'category_id' => $request->category_id,
            'sub_category_id' => $request->sub_category_id,
            'brand_id' => $request->brand_id,
            'title' => $request->title,
            'description' => $request->description,
            'returned_days' => $request->returned_days,
            'status' => $request->has('status') ? 1 : 0,
            'attributes' => $request->attribute_selection ?? [], // structured as [group_id => [attr_id, attr_id]]
            'variants' => [], // Will be parsed below
        ];

        // Parse Variants from Request
        // Assuming request sends variants as an array object or we assume structure matches
        if($request->has('variants_data')){
            $data['variants'] = json_decode($request->variants_data, true);
        }

        if($request->has('images')){
            $data['images'] = $request->images ?? '';
        }

        return $data;
    }
}
