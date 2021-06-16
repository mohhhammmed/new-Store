<?php

namespace App\Models;

use App\Observers\MainCategoryObserv;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Vendor;

//use App\Ocservers\MainCategoryObserv;
class Maincategory extends Model
{
    use HasFactory;
    protected $table='maincategories';
    protected $fillable=['translation_of','action','translation_lang','image','category'];

    public static function boot(){
      parent::boot();
        Maincategory::observe(MainCategoryObserv::class);
    }

    public function scopeSelection(){
         return $this->select('id','image','type_id','action','translation_lang','translation_of','category');
    }    public function scopeActive($val){
      return $val->where('action',1)->get();
    }

    public function getAction(){
      return $this->action==1 ? 'active':'not active';
    }
    public function translations(){
      return $this->hasMany(self::class,'translation_of');
    }
    public function average(){
        return $this->hasMany(AverageCategory::class,'maincategory_id');
    }
    public function vendors(){
      return $this->hasMany(Vendor::class,'maincategory_id');
    }
    public function subcategories(){
        return $this->hasMany(SubCategory::class,'maincategory_id');
    }

    public function parents(){
        return $this->hasMany(Parentt::class,'maincategory_id');
    }
    public function type(){
        return $this->belongsTo(TypeAllCat::class,'type_id');
    }
    public function scopeImage($q){
      return 'admin/images/categories/';
  }
}
