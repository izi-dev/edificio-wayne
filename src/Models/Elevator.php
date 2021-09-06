<?php

namespace IziDev\Models;

use Illuminate\Database\Eloquent\Model;

class Elevator extends Model
{
    protected $fillable = [
        'name',
        'description',
    ];
}