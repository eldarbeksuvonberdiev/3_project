<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\AreaTask;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $answers = Answer::orderBy('id','desc')->paginate(10);
        return view('answer.index',['answers' => $answers]);
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
    public function show(Answer $answer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Answer $answer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Answer $answer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Answer $answer)
    {
        //
    }

    public function action(Request $request, Answer $answer){
        $data = $request->validate([
            'comment' => 'required|max:255'
        ]);

        if ($request->action == 'accept') {
        
            $answer->update([
                'comment' => $request->comment,
                'status' => 2
            ]);
        
            $area_task = AreaTask::where('task_id','=',$answer->task_id)->first();
        
            $area_task->update([
                'status' => 4
            ]);
        } else {
            $answer->update([
                'comment' => $request->comment,
                'status' => 0
            ]);
        
            $area_task = AreaTask::where('task_id','=',$answer->task_id)->first();
        
            $area_task->update([
                'status' => 0
            ]);
        }
        return redirect()->back();
        
    }
}
