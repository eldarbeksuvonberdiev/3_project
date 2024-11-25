<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CategoryStoreRequest;
use App\Http\Requests\Category\CategoryUpdateRequest;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $models = Category::orderBy('id', 'desc')->paginate(10);
        return view('category.index', ['models' => $models]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryStoreRequest $request)
    {
        Category::create($request->all());
        return redirect()->back()->with(['success' => 'Category has been successfully created', 'status' => 'success']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryUpdateRequest $request, Category $category)
    {
        $category->update($request->all());
        return redirect()->back()->with(['success' => 'Category has been successfully updated', 'status' => 'warning']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->back()->with(['success' => 'Category has been successfully deleted', 'status' => 'danger']);
    }
}
