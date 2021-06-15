<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Maincategory;
use Illuminate\Notifications\Notifiable;
class Vendor extends Model
{
    use HasFactory, Notifiable;

    protected $table='vendors';
    protected $fillable=['name','address','email','logo','category_id','action','mobile'];

    public function scopeSelection($q){
        return $q->select('id','name','email','address','action','logo','category_id','mobile')->paginate(paginate_count);
    }
    public function mainCategory(){
        return $this->belongsTo(Maincategory::class,'category_id');
    }

    public function getAction(){
        return $this->action==1?'active':'not active';
    }

    public function scopeImage($q){
        return 'store/images/vendors/';
    }
}
