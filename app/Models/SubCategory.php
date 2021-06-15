<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;
    protected $table='sub_categories';
    protected $fillable=['translation_of','statue','translation_lang','image','parent_id','name','maincategory_id'];

    public function maincategory(){
        return $this->belongsTo(Maincategory::class,'maincategory_id');
    }

    public function scopeSelection($q){
        return $q->select('id','translation_of','statue','translation_lang','image','parent_id','name','maincategory_id');

    }

    public function getStatue()
    {
        return $this->statue == 1 ? 'active' : 'not active';
    }
       public function parent(){
        return $this->belongsTo(Parentt::class,'parent_id');
       }


}
