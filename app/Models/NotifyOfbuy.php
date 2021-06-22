<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotifyOfbuy extends Model
{
    use HasFactory;
    protected $table='notifications_of_buyers';
    protected $fillable=['id','counter'];
}
