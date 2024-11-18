<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'category_id',
        'doer',
        'title',
        'description',
        'file',
        'deadline',
    ];

    public function area_tasks(){
        return $this->hasMany(AreaTask::class,'task_id');
    }
}
