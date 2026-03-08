<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Annonce extends Model
{
    protected $fillable = [
        'title',
        'description',
        'category_id',
        'organisation_name',
        'organisation_address',
        'city',
        'contact_email',
        'contact_phone',
        'status',
        'user_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
