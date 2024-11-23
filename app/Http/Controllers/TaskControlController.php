<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\AreaTask;
use App\Models\Category;
use Illuminate\Http\Request;

class TaskControlController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();

        $areas = Area::orderBy('name', 'asc')->paginate(10);

        $task = new TaskController;
        $deadlines = $task->getTaskCounts();

        $area_task = new AreaTask;
        $button = 'info';

        return view('control.index', ['categories' => $categories, 'areas' => $areas,'deadlines' => $deadlines,'area_task' => $area_task,'button' => $button]);
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
