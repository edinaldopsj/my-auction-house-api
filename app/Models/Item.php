<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'description',
        'price',
        'end',
        'image_url',
        'buyer_id',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'price' => 'float',
    ];
}
