<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = [
        'task_id',
        'area_id',
        'title',
        'file',
        'comment',
        'status'
    ];

    public function task(){
        return $this->belongsTo(Task::class,'task_id');
    }
}
