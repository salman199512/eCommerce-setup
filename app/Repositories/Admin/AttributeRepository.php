<?php

namespace App\Repositories\Admin;

use App\Models\Attribute;
use App\Repositories\BaseRepository;
use Illuminate\Http\Request;

class AttributeRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'title',
        'status',
        'attribute_group_id',
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Attribute::class;
    }

    /**
     * request handler for store and update
     * @param Request $request
     * @return array
     */
    public static function requestHandler(Request $request) {
        return [
            'attribute_group_id' => $request->attribute_group_id,
            'title' => $request->title,
            'status' => $request->has('status') ? 1 : 0,
        ];
    }
}
