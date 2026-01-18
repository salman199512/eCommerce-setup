<?php

namespace App\Repositories\Admin;

use App\Models\Faq;
use App\Repositories\BaseRepository;
use Illuminate\Http\Request;

class FaqRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'question_gujarati',
        'question_english',
        'question_hindi',
        'answer_gujarati',
        'answer_english',
        'answer_hindi'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Faq::class;
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
