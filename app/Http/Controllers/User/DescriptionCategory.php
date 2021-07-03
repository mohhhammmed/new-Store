<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class DescriptionCategory extends Controller
{
    public function description_category($subcategory_id){
        $category=Subcategory::find($subcategory_id);

           if(isset($category)  && !empty($category)) {

             return view('description_category.category', compact('category'));
           }


    }
}
