<?php

namespace App\Repositories\Admin;

use App\Models\Product;
use App\Models\Setting;
use App\MyClasses\GeneralHelperFunctions;
use App\Repositories\BaseRepository;
use Illuminate\Http\Request;

class ProductRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'category_id',
        'sub_category_id',
        'name',
        'price',
        'discount',
        'discounted_price',
        'description'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Product::class;
    }

    /**
     * request handler for store and update
     * @param Request $request
     * @return array
     */
    public static function requestHandler(Request $request) {
        return [];
    }

    public function updateOrCreate_avatar(Product $product, Request $request) {
        $defaultMedia = 'https://ui-avatars.com/api/?' . http_build_query(['name' => $product->name, 'size' => '500']);
        return GeneralHelperFunctions::updateOrCreate_singleMedia_viaDropZone($product, $request->input('avatar'),  $defaultMedia);
    }

}
