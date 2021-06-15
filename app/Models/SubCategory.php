<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;
    protected $table='subcategories';
    protected $fillable=['translation_of','statue','translation_lang','image','parient_id','name'];
}
