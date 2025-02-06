<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\StoreRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Category::paginate(10));
    }

    public function all() : \Illuminate\Http\JsonResponse
    {
        return response()->json(Category::orderBy('id', 'desc')->select('id', 'name', 'slug', 'updated_at')->get());
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        return response()->json(Category::create($request->validated()));
    }

    public function show(Category $category)
    {
        return response()->json($category);
    }

    public function show_by_slug(Category $category)
    {
        return response()->json(Category::where('slug', $category->slug)->select('id', 'name')->firstOrFail());
    }

    // update the specified resource in storage.
    public function update(StoreRequest $request, Category $category)
    {   
        $category->update($request->validated());
        return response()->json($category);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json('ok');
    }
}
