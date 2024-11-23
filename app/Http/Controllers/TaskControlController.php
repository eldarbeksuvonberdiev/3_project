<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\AreaTask;
use App\Models\Category;
use Illuminate\Http\Request;

class TaskControlController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();

        $areas = Area::orderBy('name', 'asc')->paginate(10);

        $task = new TaskController;
        $deadlines = $task->getTaskCounts();

        $area_task = new AreaTask;

        $button = 'info';

        return view('control.index', ['categories' => $categories, 'areas' => $areas,'deadlines' => $deadlines,'area_task' => $area_task,'button' => $button,'status' => 'all']);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function task(Area $area, Category $category, string $status)
    {
        if ($status == 'all') {
            
            $tasks = AreaTask::where('category_id',$category->id)->where('area_id',$area->id)->get();

            return view('control.task',['tasks' => $tasks,'area_name' => $area->name]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function sort(int $status)
    {
        dd($status);
    }


}
