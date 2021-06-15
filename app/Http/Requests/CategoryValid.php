<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryValid extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
           
            'image'=>'required_Without:id|mimes:jpg,png',
            'category'=>'required|array',
            'category.*.category'=>'required|string',
            'category.*.translation_lang'=>'required|string',
            'category.*.action'=>'numeric|min:1',
        ];
    }
}
