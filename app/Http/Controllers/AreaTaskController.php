<?php

namespace App\Http\Controllers;

use App\Models\AreaTask;
use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Task;
use Illuminate\Http\Request;

class AreaTaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $area_tasks = AreaTask::orderBy('id','desc')->paginate(10);
        return view('area_task.index',['area_tasks' => $area_tasks]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tasks = Task::all();
        $areas = Area::all();
        return view('area_task.create',['areas' => $areas,'tasks' => $tasks]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'task_id' => 'required|integer',
            'area_id' => 'required|array'
        ]);
        $area = $request->area_id;

        $task = Task::where('id','=',$request->task_id)->first();
        
        $task->area_tasks->attach($area);
        
        return redirect()->route('area_task.index')->with(['success' => 'Area Tasks has been successfully created','status' => 'success']);
    }

    /**
     * Display the specified resource.
     */
    public function show(AreaTask $areaTask)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AreaTask $areaTask)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AreaTask $areaTask)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AreaTask $areaTask)
    {
        //
    }
}
