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
           'email'=>'required|email|unique:orders',
            'name'=>'required|string',
            'address'=>'required|string',
            'id'=>'required|numeric|exists:sub_categories,id',
            'mobile'=>'required|numeric|unique:orders',
            'category'=>'required|exists:sub_categories,name'
        ];
    }
}
