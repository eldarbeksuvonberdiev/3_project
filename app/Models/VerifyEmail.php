<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VerifyEmail extends Model
{
    protected $fillable = [
        'user_id',
        'code'
    ];
}
