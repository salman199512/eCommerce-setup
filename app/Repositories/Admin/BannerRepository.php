<?php

namespace App\Repositories\Admin;

use App\Models\Banner;
use App\Repositories\BaseRepository;
use Illuminate\Http\Request;

class BannerRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'title',
        'status',
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Banner::class;
    }

    /**
     * request handler for store and update
     * @param Request $request
     * @return array
     */
    public static function requestHandler(Request $request) {
        return [
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'link' => $request->link,
            'position' => $request->position ?? 'main',
            'sort_order' => $request->sort_order ?? 0,
            'status' => $request->status ? 1 : 0,
        ];
    }
}
