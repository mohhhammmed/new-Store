<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Description extends Model
{
    use HasFactory;
    protected $table='descriptions' ;
    protected $fillable=['id','subcategory_id','description'];

    public function subcategory(){
        return $this->belongsTo(SubCategory::class,'subcategory_id');
    }
}
