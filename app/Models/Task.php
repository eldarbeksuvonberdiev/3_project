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
        return $this->belongsToMany(AreaTask::class,'area_tasks','task_id','area_id');
    }

    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }
}
