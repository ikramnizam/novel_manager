<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Novel extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'synopsis',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];
}
