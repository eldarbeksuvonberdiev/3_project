<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AreaTask extends Model
{
    protected $fillable = [
        'area_id',
        'task_id',
        'status'
    ];

    public function area(){
        return $this->belongsTo(Area::class,'area_id');
    }

    public function task(){
        return $this->belongsTo(Task::class,'task_id');
    }

}
