<?php

namespace App\Http\Requests\Admin\ContentManagement;

use App\Http\Requests\BaseRequest;
use App\Models\ContentManagement;
use App\Repositories\Admin\ContentManagementRepository;

class MasterRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return ContentManagement::$rules;
    }

    /**
     * Handle an incoming request.
     */
    public function prepareForValidation() {
        $this->merge(ContentManagementRepository::requestHandler($this));
    }
}
