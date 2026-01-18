<?php

namespace App\Repositories\Admin;

use App\Models\Brand;
use App\MyClasses\GeneralHelperFunctions;
use App\Repositories\BaseRepository;
use Illuminate\Http\Request;

class BrandRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'status',
        'uuid'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Brand::class;
    }

    public static function requestHandler(Request $request) {
        return [
            'name' => $request->name,
            'slug' => $request->slug ?? \Illuminate\Support\Str::slug($request->name),
            'meta_title' => $request->meta_title ?? $request->name,
            'meta_description' => $request->meta_description,
            'meta_keywords' => $request->meta_keywords,
            'status' => 1,
        ];
    }

    public function updateOrCreate_brand_icon(Brand $brand, Request $request) {
        $defaultMedia = 'https://ui-avatars.com/api/?' . http_build_query(['name' => $brand->name, 'size' => '500']);
        return GeneralHelperFunctions::updateOrCreate_singleMedia_viaDropZone($brand, $request->input('avatar'),  $defaultMedia);
    }
}
