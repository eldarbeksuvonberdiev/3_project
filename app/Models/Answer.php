<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = [
        'task_id',
        'area_id',
        'title',
        'comment',
        'status'
    ];
}
