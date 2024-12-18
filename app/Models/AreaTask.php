<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AreaTask extends Model
{
    protected $fillable = [
        'area_id',
        'task_id',
        'category_id',
        'areaTask_deadline',
        'status'
    ];

    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }

    public function area(){
        return $this->belongsToMany(Area::class,'area_id');
    }

    public function task(){
        return $this->belongsTo(Task::class,'task_id');
    }

    public function answer(){
        return $this->hasOne(Answer::class,'task_id','task_id');
    }

}
