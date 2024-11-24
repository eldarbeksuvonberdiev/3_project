<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name'
    ];

    public function tasks(){
        return $this->hasMany(Task::class,'category_id');
    }

    public function area_tasks(){
        return $this->hasMany(AreaTask::class,'category_id');    
    }
}
