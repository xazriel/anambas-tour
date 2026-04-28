<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Culture extends Model
{
    // Supaya aman, kita definisikan nama tabelnya secara manual
    protected $table = 'cultures';

    protected $fillable = [
        'name', 
        'slug', 
        'district', 
        'description_id', 
        'description_en', 
        'thumbnail'
    ];
}