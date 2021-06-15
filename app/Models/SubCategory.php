<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;
    protected $table='sub_categories';
    protected $fillable=['translation_of','statue','translation_lang','image','parient_id','name','maincategory_id'];

    public function maincategory(){
        return $this->belongsTo(Maincategory::class,'maincategory_id');
    }
}
