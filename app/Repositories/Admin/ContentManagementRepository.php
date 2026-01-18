<?php

namespace App\Repositories\Admin;

use App\Models\ContentManagement;
use App\Repositories\BaseRepository;
use Illuminate\Http\Request;

class ContentManagementRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'title',
        'slug',
        'description',
        'meta_title',
        'meta_keyword',
        'meta_description'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return ContentManagement::class;
    }

    /**
     * request handler for store and update
     * @param Request $request
     * @return array
     */
    public static function requestHandler(Request $request) {
        return [];
    }
}
