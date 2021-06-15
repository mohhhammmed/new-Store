<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lang extends Model
{
    use HasFactory;
    protected $table='langs';
    protected $fillable=['name','action','abbr','direction','locale'];
    public function scopedata($d){
        return $d->select('name','action','abbr','direction','id')->get();
    }
    public function getactionAttribute($val){
             return $val==1 ? 'active' : 'not active';
    } 
}
