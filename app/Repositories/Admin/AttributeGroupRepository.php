<?php

namespace App\Repositories\Admin;

use App\Models\AttributeGroup;
use App\Repositories\BaseRepository;
use Illuminate\Http\Request;

class AttributeGroupRepository extends BaseRepository
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
        return AttributeGroup::class;
    }

    /**
     * request handler for store and update
     * @param Request $request
     * @return array
     */
    public static function requestHandler(Request $request) {
        return [
            'title' => $request->title,
            'status' => $request->has('status') ? 1 : 0,
        ];
    }
}
