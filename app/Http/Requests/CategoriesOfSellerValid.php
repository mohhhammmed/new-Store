<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoriesOfSellerValid extends FormRequest
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
            'name'=>'required|string',
            'email'=>'required|email|unique:categories_of_sellers,email',
            'mobile'=>'required|numeric|unique:categories_of_sellers,mobile',
            'address'=>'required|string',
            'category'=>'required|string',
            'the_price'=>'required|numeric',
            'image'=>'required|mimes:jpg,png,jpeg',
            'description'=>'required|string',
            'negotiate'=>'sometimes|nullable|string',
            'condition'=>'required|string',
            'paying_off'=>'required|string'
        ];
    }
}
