<?php

namespace App\Models;

use App\Models\SubCategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    protected $table='images';
    protected $fillable=['id','image','subcategory_id'];

    public function subcategory(){
        return $this->belongsTo(SubCategory::class,'subcategory_id');
    }
}
