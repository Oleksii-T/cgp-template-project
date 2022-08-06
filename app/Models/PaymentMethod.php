<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    protected $fillable = [
        'user_id',
        'is_default',
        'token',
        'data',
    ];

    protected $casts = [
        'data' => 'array'
    ];
}
