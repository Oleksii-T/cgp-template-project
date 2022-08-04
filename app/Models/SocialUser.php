<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialUser extends Model
{
    protected $fillable = [
        'user_id',
        'provider',
        'token'
    ];
}
