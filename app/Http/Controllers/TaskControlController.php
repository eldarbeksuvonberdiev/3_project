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

        return view('control.index', ['categories' => $categories, 'areas' => $areas,'deadlines' => $deadlines,'area_task' => $area_task,'button' => 'info','status' => 'all']);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function task(Area $area, Category $category, string $status)
    {
        if ($status == 'all') {
            
            $tasks = AreaTask::where('category_id',$category->id)->where('area_id',$area->id)->get();
        }elseif ($status == 'two_days') {

            $tasks = AreaTask::where('category_id',$category->id)->where('area_id',$area->id)->whereRaw('DATEDIFF(areaTask_deadline, CURDATE()) = 2')->get();
        }elseif ($status == 'one_day') {
            
            $tasks = AreaTask::where('category_id',$category->id)->where('area_id',$area->id)->whereRaw('DATEDIFF(areaTask_deadline, CURDATE()) = 1')->get();
        }elseif ($status == 'today') {
            
            $tasks = AreaTask::where('category_id',$category->id)->where('area_id',$area->id)->whereRaw('DATEDIFF(areaTask_deadline, CURDATE()) = 0')->get();
        }else {
            
            $tasks = AreaTask::where('category_id',$category->id)->where('area_id',$area->id)->whereRaw('DATEDIFF(areaTask_deadline, CURDATE()) < 0')->get();
        }
        return view('control.task',['tasks' => $tasks,'area_name' => $area->name]);
    }

    /**
     * Sort a newly created resource in storage.
     */
    public function sort(int $status)
    {
        $categories = Category::all();

        $areas = Area::orderBy('name', 'asc')->paginate(10);

        $task = new TaskController;
        $deadlines = $task->getTaskCounts();

        $area_task = new AreaTask;

        switch ($status) {
            case '2':
                $stat = 'two_days';
                $button = 'success';
                break;
            case '1':
                $stat = 'one_day';
                $button = 'warning';
                break;
            case '0':
                $stat = 'today';
                $button = 'danger';
                break;
            case '-1':
                $stat = 'passed';
                $button = 'danger';
                break;
            
            default:
                abort(404);
                break;
        }

        return view('control.index', ['categories' => $categories, 'areas' => $areas,'deadlines' => $deadlines,'area_task' => $area_task,'button' => $button,'status' => $stat]);
    }


}
