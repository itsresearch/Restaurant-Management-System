<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    //
     protected $fillable = [
        'title',
        'details',
        'price',
        'image',
        'quantity',
    ];
}
