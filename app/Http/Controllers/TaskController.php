<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

            $tasks = Task::whereBetween('deadline', [$start, $end])->orderBy('created_at', 'desc')->paginate(10);
        } else {

            $tasks = Task::orderBy('id', 'desc')->paginate(10);
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
        return view('task.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
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
        }
        Task::create($data);
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
        return Task::selectRaw("
        COUNT(*) AS total_tasks,
        COUNT(CASE WHEN DATEDIFF(deadline, CURDATE()) = 2 THEN 1 END) AS two_days_left,
        COUNT(CASE WHEN DATEDIFF(deadline, CURDATE()) = 1 THEN 1 END) AS one_day_left,
        COUNT(CASE WHEN DATE(deadline) = CURDATE() THEN 1 END) AS deadline_today,
        COUNT(CASE WHEN deadline < CURDATE() THEN 1 END) AS deadline_passed
    ")->first();
    }


    public function sortTasksByStatus($status)
    {
        $query = DB::table('tasks')
        ->join('categories', 'tasks.category_id', '=', 'categories.id')
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

        return $query->orderBy('deadline', 'desc')->paginate(10);
    }
}
