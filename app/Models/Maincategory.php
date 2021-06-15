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

    public function getCategories(){
         return $this->select('id','image','action','translation_lang','translation_of','category')->get();
    }
    public function scopeActive($val){
      return $val->where('action',1)->get();
    }

    public function getAction(){
      return $this->action==1 ? 'active':'not active';
    }
    public function transes(){
      return $this->hasMany(self::class,'translation_of');
    }
    public function vendors(){
      return $this->hasMany(Vendor::class,'category_id');
    }
    public function scopeImage($q){
      return 'store/images/categories/';
  }
}
