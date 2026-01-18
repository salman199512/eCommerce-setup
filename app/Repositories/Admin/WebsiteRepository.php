<?php

namespace App\Repositories\Admin;

use App\Models\Blog;
use App\Models\Website;
use App\MyClasses\GeneralHelperFunctions;
use App\Repositories\BaseRepository;
use Illuminate\Http\Request;

class WebsiteRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'heading',
        'sub_heading',
        'type',
        'description'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Website::class;
    }

    /**
     * request handler for store and update
     * @param Request $request
     * @return array
     */
    public static function requestHandler(Request $request) {
        return [];
    }

    public function updateOrCreate_avatar(Website $website, Request $request) {
        $defaultMedia = 'https://ui-avatars.com/api/?' . http_build_query(['name' => $website->name, 'size' => '500']);
        return GeneralHelperFunctions::updateOrCreate_singleMedia_viaDropZone($website, $request->input('avatar'),  $defaultMedia);
    }
}
