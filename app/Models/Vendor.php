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
    protected $fillable=['name','address','email','logo','maincategory_id','action','mobile'];

    public function scopeSelection($q){
        return $q->select('id','name','email','address','action','logo','maincategory_id','mobile');
    }
    public function maincategory(){
        return $this->belongsTo(Maincategory::class,'maincategory_id');
    }

    public function getAction(){
        return $this->action==1?'active':'not active';
    }

    public function scopePathImage($q){
        return 'admin/images/vendors/';
    }
}
