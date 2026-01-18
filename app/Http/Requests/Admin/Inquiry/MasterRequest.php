<?php

namespace App\Http\Requests\Admin\Inquiry;

use App\Http\Requests\BaseRequest;
use App\Models\Inquiry;
use App\Repositories\Admin\InquiryRepository;

class MasterRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return Inquiry::$rules;
    }

    /**
     * Handle an incoming request.
     */
    public function prepareForValidation() {
        $this->merge(InquiryRepository::requestHandler($this));
    }
}
