<?php

namespace App\Http\Requests\Admin\ContentManagement;

use App\Models\ContentManagement;

class UpdateRequest extends MasterRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */


    public function rules()
    {
        $rules = ContentManagement::$rules;
        $rules['slug'] = 'required|string|unique:content_managements,slug,' . $this->route('contentManagement')->id . ',id,deleted_at,NULL';
        return $rules;
    }
}
