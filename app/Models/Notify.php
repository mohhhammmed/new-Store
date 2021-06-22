<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notify extends Model
{
    use HasFactory;
    protected $table='notifications';
    protected $fillable=['id','counter','belongs_to_table'];

    public function scopeGetNotifyOrder($q){
        return $q->where('belongs_to_table','orders')->first() !=null?$q->where('belongs_to_table','orders')->first():'';
    }
    public function scopeGetNotifyBuy($q){
        return $q->where('belongs_to_table','categories_of_sellers')->first() != null?$q->where('belongs_to_table','categories_of_sellers')->first() :'';
    }
}
