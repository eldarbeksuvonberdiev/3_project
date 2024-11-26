<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Http\Controllers\Controller;
use App\Http\Requests\Answer\AnswerStoreRequest;
use App\Models\AreaTask;
use Illuminate\Http\Request;

class AnswerController extends Controller
{

    public function index()
    {
        $answers = Answer::orderBy('id', 'desc')->paginate(10);
        return view('answer.index', ['answers' => $answers]);
    }

    public function action(AnswerStoreRequest $request, Answer $answer)
    {
        
        if ($request->action == 'accept') {

            $answer->update([
                'comment' => $request->comment,
                'status' => 2
            ]);

            $area_task = AreaTask::where('task_id', '=', $answer->task_id)->first();

            $area_task->update([
                'status' => 4
            ]);
        } else {
            $answer->update([
                'comment' => $request->comment,
                'status' => 0
            ]);

            $area_task = AreaTask::where('task_id', '=', $answer->task_id)->first();

            $area_task->update([
                'status' => 0
            ]);
        }
        return redirect()->back();
    }

    public function notifications(){
        $answers = Answer::where('status',1)->get();
        return view('answer.notification',['answers' => $answers]);
    }
}
