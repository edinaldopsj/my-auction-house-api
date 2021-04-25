<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'amount',
        'bidded_at',
        'bidder_id',
        'item_id',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'amount' => 'float',
    ];
}
