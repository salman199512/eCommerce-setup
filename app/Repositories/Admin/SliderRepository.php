<?php

namespace App\Repositories\Admin;

use App\Models\Slider;
use App\Repositories\BaseRepository;
use Illuminate\Http\Request;

class SliderRepository extends BaseRepository
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
        return Slider::class;
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
            'button_text' => $request->button_text,
            'link' => $request->link,
            'sort_order' => $request->sort_order ?? 0,
            'status' => $request->status ? 1 : 0,
        ];
    }
}
