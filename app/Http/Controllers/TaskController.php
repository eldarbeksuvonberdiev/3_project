<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\AreaTask;
use App\Models\Category;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->filled('start_date') && $request->filled('end_date')) {

            $start = $request->start_date;

            $end = $request->end_date;

            $tasks = AreaTask::whereBetween('areaTask_deadline', [$start, $end])->orderBy('created_at', 'desc')->paginate(10);
        } else {

            $tasks = AreaTask::orderBy('id', 'desc')->paginate(10);
        }

        $deadlines = $this->getTaskCounts();

        return view('task.index', ['tasks' => $tasks, 'deadlines' => $deadlines]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $users = Area::all();
        return view('task.create', ['categories' => $categories,'areas' => $users]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'doer' => 'required',
            'title' => 'required',
            'description' => 'nullable',
            'file' => 'nullable|mimes:doc,docx,pdf,xls,xlsx,ppt,pptx',
            'deadline' => 'required|date',
            'category_id' => 'required|integer',
            'area_id' => 'required|array',
        ]);
        $areas = $data['area_id'];

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();
            $filename = date("y-m-d_h-i-s_") . time() . '.' . $extension;
            $file->move('files/', $filename);
            $data['file'] = 'files/' . $filename;
        }
        $task = Task::create($data);
        foreach ($areas as $area) {
            AreaTask::create([
                'area_id' => $area,
                'task_id' => $task->id,
                'category_id' => $task->category_id,
                'areaTask_deadline' => $task->deadline
            ]);
        }

        return redirect()->route('task.index')->with(['success' => 'Task has been successfully created', 'status' => 'success']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        $categories = Category::all();
        return view('task.edit', ['task' => $task, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $data = $request->validate([
            'category_id' => 'required|integer',
            'doer' => 'required',
            'title' => 'required',
            'description' => 'nullable',
            'file' => 'nullable|mimes:doc,docx,pdf,xls,xlsx,ppt,pptx',
            'deadline' => 'required|date'
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();
            $filename = date("y-m-d_h-i-s_") . time() . '.' . $extension;
            $file->move('files/', $filename);
            $data['file'] = 'files/' . $filename;
        } else {
            unset($data['file']);
        }
        $task->update($data);

        return redirect()->route('task.index')->with(['success' => 'Task has been successfully updated', 'status' => 'warning']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('task.index')->with(['success' => 'Task has been successfully deleted', 'status' => 'danger']);
    }

    public function sort($status)
    {

        $deadlines = $this->getTaskCounts();
        
        $tasks = $this->sortTasksByStatus($status);
        return view('task.index', ['tasks' => $tasks, 'deadlines' => $deadlines]);
    }


    public function getTaskCounts()
    {
        return AreaTask::selectRaw("
            COUNT(*) AS total_tasks,
            COUNT(CASE WHEN DATEDIFF(areaTask_deadline, CURDATE()) = 2 AND status != 3 THEN 1 END) AS two_days_left,
            COUNT(CASE WHEN DATEDIFF(areaTask_deadline, CURDATE()) = 1 AND status != 3 THEN 1 END) AS one_day_left,
            COUNT(CASE WHEN DATE(areaTask_deadline) = CURDATE() AND status != 3 THEN 1 END) AS deadline_today,
            COUNT(CASE WHEN areaTask_deadline < CURDATE() AND status != 3 THEN 1 END) AS deadline_passed
        ")->first();
    }


    public function sortTasksByStatus($status)
    {
        $query = new AreaTask;
        switch ($status) {
            case 2:
                $query->whereRaw('DATEDIFF(areaTask_deadline, CURDATE()) = 2');
                break;
            case 1:
                $query->whereRaw('DATEDIFF(areaTask_deadline, CURDATE()) = 1');
                break;
            case 0:
                $query->whereRaw('DATEDIFF(areaTask_deadline, CURDATE()) = 0');
                break;
            case -1:
                $query->whereRaw('DATEDIFF(areaTask_deadline, CURDATE()) < 0');
                break;
        }
        return $query->orderBy('areaTask_deadline', 'desc')->paginate(10);
    }
}
