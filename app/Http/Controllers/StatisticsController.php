<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Statistics\StatisticsFilterRequest;
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

    public function filter(StatisticsFilterRequest $request)
    {  
        $date = $request->all();
        $categories = Category::all();
        $area_task = new AreaTask;
        return view('statistics.index', ['categories' => $categories,'area_task' => $area_task, 'date' => $date]);
    }

    public function category_index(){
        $categories = Category::all();
        $areas = Area::all();
        $area_task = new AreaTask;
        return view('statistics.index1',['categories' => $categories,'areas' => $areas,'area_task' => $area_task]);
    }

}
