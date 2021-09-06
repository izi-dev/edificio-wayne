<?php

namespace IziDev\Models;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    protected $fillable = [
        'floor_origin_id',
        'floor_destiny_id',
        'sequence_id',
    ];

    public function origin()
    {
        return $this->belongsTo(Floor::class, 'floor_origin_id');
    }

    public function destiny()
    {
        return $this->belongsTo(Floor::class, 'floor_destiny_id');
    }
}