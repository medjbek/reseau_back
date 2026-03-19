<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class AnnonceStat extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'annonce_stats';

    protected $fillable = [
        'annonce_id',
        'views',
    ];

    protected $casts = [
        'annonce_id' => 'integer',
        'views' => 'integer',
    ];
}