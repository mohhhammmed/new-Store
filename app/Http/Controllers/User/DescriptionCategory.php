<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class DescriptionCategory extends Controller
{
    public function category($category_id){
        $category=SubCategory::find($category_id);
        return view('description_category.category',compact('category'));
    }
}
