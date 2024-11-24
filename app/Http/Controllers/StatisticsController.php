<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class StatisticsController extends Controller
{
    

    public function index(){
        $categories = Category::all();
        return view('statistics.index',['categories' => $categories]);
    }

    public function filter(){
        
    }
}
