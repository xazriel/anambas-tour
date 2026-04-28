<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Culinary extends Model
{
    protected $fillable = ['name', 'slug', 'district', 'description_id', 'description_en', 'thumbnail'];
}