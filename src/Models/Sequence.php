<?php

namespace IziDev\Models;

use Illuminate\Database\Eloquent\Model;

class Sequence extends Model
{
    protected $fillable = [
        'start',
        'end',
        'period',
    ];

    protected $casts = [
        'start' => 'datetime',
        'end' => 'datetime',
    ];

    public function requests()
    {
        return $this->hasMany(Request::class);
    }
}