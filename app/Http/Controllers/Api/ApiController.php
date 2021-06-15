<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Maincategory;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function grtcategories(){
       $data= Maincategory::select('action','category','translation_lang','translation_of')->get();

       return response()->json($data);
    }
}
