<?php

namespace App\Http\Requests\Admin;

use App\Models\Brand;
use Illuminate\Foundation\Http\FormRequest;

class UpdateBrandRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = Brand::$rules;
        $rules['name'] = 'required|string|max:255|unique:brands,name,'.$this->route('brand')->id.',id,deleted_at,NULL';
        return $rules;
    }
}
