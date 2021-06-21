<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactValid extends FormRequest
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
           'email'=>'required|email|exists:users',
            'name'=>'required|string',
            'id'=>'required|numeric|exists:sub_categories,id',
            'mobile'=>'required|numeric',
            'category'=>'required|exists:sub_categories,name'
        ];
    }
}
