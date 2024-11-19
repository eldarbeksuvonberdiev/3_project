<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $fillable = [
        'user_id',
        'name'
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function area_tasks(){
        return $this->belongsToMany(AreaTask::class,'area_tasks','area_id','task_id');
    }
}
