<?php

namespace App\Models;


use App\Models\Image;
use App\Observers\SubCategoryObserv;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;
    protected $table='sub_categories';
    protected $fillable=['translation_of','statue','translation_lang','image','the_price','parent_id','name','maincategory_id'];



    public static function boot(){
       parent::boot();
       SubCategory::observe(SubCategoryObserv::class);
    }

    public function images(){
        return $this->hasMany(Image::class,'subcategory_id');
    }

    public function maincategory(){
        return $this->belongsTo(Maincategory::class,'maincategory_id');
    }

    public function scopeSelection($q){
        return $q->select('id','translation_of','statue','translation_lang','the_price','image','parent_id','name','maincategory_id');

    }
    public function scopePathImage($q){
        return 'admin/images/subcategories/';

    }

    public function getActive(){
        return $this->statue==1;
    }

    public function getStatue()
    {
        return $this->statue == 1 ? 'active' : 'not active';
    }
       public function parent(){
        return $this->belongsTo(Parentt::class,'parent_id');
       }

    public function description(){
        return $this->hasOne(Description::class,'subcategory_id');
    }



}
