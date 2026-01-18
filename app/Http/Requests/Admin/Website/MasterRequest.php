<?php

namespace App\Http\Requests\Admin\Website;

use App\Http\Requests\BaseRequest;
use App\Models\Website;
use App\Repositories\Admin\WebsiteRepository;

class MasterRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return Website::$rules;
    }

    /**
     * Handle an incoming request.
     */
    public function prepareForValidation() {
        $this->merge(WebsiteRepository::requestHandler($this));
    }
}
