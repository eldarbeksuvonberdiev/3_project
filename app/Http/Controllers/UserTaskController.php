<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\AreaTask;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserTaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::where('id', Auth::user()->id)->first();
        $tasks = AreaTask::where('area_id', $user->area->id)->orderBy('id', 'desc')->paginate(10);
        $deadlines = $this->getTaskCounts();
        return view('user_task.index', ['tasks' => $tasks, 'deadlines' => $deadlines]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(AreaTask $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, AreaTask $user_task)
    {
        $request->validate([
            'status' => 'required'
        ]);
        $user_task->update(['status' => $request->status]);
        return redirect()->route('user_task.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AreaTask $user_task)
    {
        $data = $request->validate([
            'title' => 'required',
            'file' => 'nullable|mimes:doc,docx,pdf,xls,xlsx,ppt,pptx'
        ]);
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();
            $filename = date("y-m-d_h-i-s_") . time() . '.' . $extension;
            $file->move('files/', $filename);
            $data['file'] = 'files/' . $filename;
        }
        $answeer = Answer::create([
            'task_id' => $user_task->task_id,
            'area_id' => $user_task->area_id,
            'title' => $data['title'],
            'file' => $data['file'],
        ]);

        $user_task->update([
            'status' => 3
        ]);

        return redirect()->route('user_task.index')->with(['success' => 'Task status has been successfully changed', 'status' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AreaTask $task)
    {
        //
    }

    public function sort($status)
    {

        $deadlines = $this->getTaskCounts();

        $tasks = $this->sortTasksByStatus($status);

        return view('user_task.index', ['tasks' => $tasks, 'deadlines' => $deadlines]);
    }


    public function getTaskCounts()
    {
        return Task::join('area_tasks', 'tasks.id', '=', 'area_tasks.task_id')
            ->where('area_tasks.area_id', Auth::user()->area->id)
            ->selectRaw("
            COUNT(*) AS total_tasks,
            COUNT(CASE WHEN DATEDIFF(deadline, CURDATE()) = 2 THEN 1 END) AS two_days_left,
            COUNT(CASE WHEN DATEDIFF(deadline, CURDATE()) = 1 THEN 1 END) AS one_day_left,
            COUNT(CASE WHEN DATE(deadline) = CURDATE() THEN 1 END) AS deadline_today,
            COUNT(CASE WHEN deadline < CURDATE() THEN 1 END) AS deadline_passed
        ")
            ->first();
    }


    public function sortTasksByStatus($status)
    {
        $query = Task::join('area_tasks', 'tasks.id', '=', 'area_tasks.task_id') 
            ->join('categories', 'tasks.category_id', '=', 'categories.id')   
            ->where('area_tasks.area_id', Auth::user()->area->id)            
            ->select('tasks.*', 'categories.name as category_name');        
    
        switch ($status) {
            case 2:
                $query->whereRaw('DATEDIFF(deadline, CURDATE()) = 2');        
                break;
            case 1:
                $query->whereRaw('DATEDIFF(deadline, CURDATE()) = 1');        
                break;
            case 0:
                $query->whereRaw('DATEDIFF(deadline, CURDATE()) = 0');        
                break;
            case -1:
                $query->whereRaw('DATEDIFF(deadline, CURDATE()) < 0');        
                break;
        }
    
        return $query->orderBy('deadline', 'desc') ->paginate(10);               
    }
    
}
