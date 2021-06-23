<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table='orders';
    protected $fillable=['name','email','address','mobile','category','image','the_price','paying_off'];

    public function scopeSelection($q){
        return $q->select('id','name','email','mobile','address','category','image','the_price','paying_off');
    }
}
