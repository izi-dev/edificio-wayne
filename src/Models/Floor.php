<?php

namespace IziDev\Models;

use Illuminate\Database\Eloquent\Model;

class Floor extends Model
{
    protected $fillable = [
        'name',
        'description',
        'number',
    ];
}