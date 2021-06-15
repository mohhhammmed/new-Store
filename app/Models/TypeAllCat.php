<?php

namespace App\Models;

use App\Models\Maincategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeAllCat extends Model
{
    use HasFactory;
    protected $table='typecategories';
    protected $fillable=['type','id'];

    public function maincategories(){
      return $this->hasMany(Maincategory::class,'type_id');
    }

    public function subcategories(){
        return $this->hasManyThrough(SubCategory::class,\App\Models\Maincategory::class,'type_id','maincategory_id');
    }
}
