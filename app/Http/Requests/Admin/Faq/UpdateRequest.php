<?php

namespace App\Http\Requests\Admin\Faq;

class UpdateRequest extends MasterRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        $rules = parent::rules();
        
        return $rules;
    }
}
