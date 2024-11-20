<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\AreaTask;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserTaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::where('id',Auth::user()->id)->first();
        $tasks = AreaTask::where('area_id',$user->area->id)->orderBy('id','desc')->paginate(10);
        return view('user_task.index',['tasks' => $tasks]);
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
            $filename = date("y-m-d_h-i-s_"). time() .'.'. $extension;
            $file->move('files/',$filename);
            $data['file'] = 'files/'.$filename;
        }
        $answeer = Answer::create([
            'task_id' => $user_task->task_id,
            'area_id' => $user_task->area_id,
            'title' => $data['title'],
            'file' => $data['file']
        ]);

        $user_task->update([
            'status' => 3
        ]);

        return redirect()->route('user_task.index')->with(['success' => 'Task status has been successfully changed','status' => 'success']);

    }   

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AreaTask $task)
    {
        //
    }
}
