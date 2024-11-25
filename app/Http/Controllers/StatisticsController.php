<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\AreaTask;
use App\Models\Category;
use Illuminate\Http\Request;

class StatisticsController extends Controller
{


    public function index()
    {
        $categories = Category::all();
        $area_task = new AreaTask;
        return view('statistics.index', ['categories' => $categories,'area_task' => $area_task]);
    }

    public function filter(Request $request)
    {  
        $date = $request->validate([
            'start' => 'required|date',
            'end' => 'required|date',
        ]);
        $categories = Category::all();
        $area_task = new AreaTask;
        $area_task = $area_task->whereBetween('areaTask_deadline', [$date['start'], $date['end']]);
        return view('statistics.index', ['categories' => $categories,'area_task' => $area_task]);
    }

    public function category_index(){
        $categories = Category::all();
        $areas = Area::all();
        $area_task = new AreaTask;
        return view('statistics.index1',['categories' => $categories,'areas' => $areas,'area_task' => $area_task]);
    }

}
