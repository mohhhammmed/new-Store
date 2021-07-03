<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Subcategory;

class Parentt extends Model
{
    use HasFactory;

    use HasFactory;
    protected $table='parents';
    protected $fillable=['id','maincategory_id','type','translation_lang'];

    public function maincategory(){
        return $this->belongsTo(Maincategory::class,'maincategory_id');
    }


    public function subcategories(){
        return $this->hasMany(SubCategory::class,'parent_id');
    }
}
