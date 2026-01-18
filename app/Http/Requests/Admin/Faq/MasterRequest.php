<?php

namespace App\Http\Requests\Admin\Faq;

use App\Http\Requests\BaseRequest;
use App\Models\Faq;
use App\Repositories\Admin\FaqRepository;

class MasterRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return Faq::$rules;
    }

    /**
     * Handle an incoming request.
     */
    public function prepareForValidation() {
        $this->merge(FaqRepository::requestHandler($this));
    }
}
