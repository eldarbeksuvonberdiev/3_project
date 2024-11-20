<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Http\Controllers\Controller;
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
            
            $tasks = Task::whereBetween('deadline', [$start, $end])->orderBy('created_at', 'desc')->paginate(10);
        } else {
            
            $tasks = Task::orderBy('id', 'desc')->paginate(10);
        }
    
        return view('task.index', ['tasks' => $tasks]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('task.create',['categories' => $categories]);
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
            $filename = date("y-m-d_h-i-s_"). time() .'.'. $extension;
            $file->move('files/',$filename);
            $data['file'] = 'files/'.$filename;
        }
        Task::create($data);
        return redirect()->route('task.index')->with(['success' => 'Task has been successfully created','status' => 'success']);
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
        return view('task.edit',['task' => $task,'categories' => $categories]);
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
            $filename = date("y-m-d_h-i-s_"). time() .'.'. $extension;
            $file->move('files/',$filename);
            $data['file'] = 'files/'.$filename;
        }else {
            unset($data['file']);
        }
        $task->update($data);

        return redirect()->route('task.index')->with(['success' => 'Task has been successfully updated','status' => 'warning']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('task.index')->with(['success' => 'Task has been successfully deleted','status' => 'danger']);

    }



}
