<?php

namespace App\Repositories\Admin;

use App\Models\Inquiry;
use App\Repositories\BaseRepository;
use Illuminate\Http\Request;

class InquiryRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'name',
        'email',
        'phone',
        'service',
        'message'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Inquiry::class;
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
