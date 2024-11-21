<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::where('role','!=','admin')->get();
        $models = Area::orderBy('id','desc')->paginate(10);
        return view('area.index',['models' => $models,'users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::where('role','!=','admin')->get();
        return view('area.create',['users' => $users]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|integer',
            'name' => 'required'
        ]);
        Area::create($data);
        return redirect()->route('area.index')->with(['success' => 'Area has been successfully created','status' => 'success']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Area $area)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Area $area)
    {
        $users = User::all();
        return view('area.edit',['model' => $area,'users' => $users]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Area $area)
    {
        $data = $request->validate([
            'user_id' => 'required|integer',
            'name' => 'required'
        ]);
        $area->update($data);
        return redirect()->route('area.index')->with(['success' => 'Area has been successfully updated','status' => 'warning']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Area $area)
    {
        $area->delete();
        return redirect()->route('area.index')->with(['success' => 'Area has been successfully deleted','status' => 'danger']);
    }
}
