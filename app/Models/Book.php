<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    //
    protected $fillable = [
        'name',
        'phone',
        'email',
        'guest',
        'date',
        'time',
        'status',
    ];
}
