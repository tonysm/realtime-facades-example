<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SourceProvider extends Model
{
    protected $fillable = [
        'type',
        'name',
        'meta',
    ];

    protected $casts = [
        'meta' => 'json',
    ];
}
