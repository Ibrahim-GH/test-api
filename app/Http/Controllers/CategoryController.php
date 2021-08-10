<?php

namespace App\Http\Controllers;


use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get retrieve all Categories records
        $cats = Category::paginate(10);
        return CategoryResource::collection($cats);

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return CategoryResource
     */
    public function store(CreateCategoryRequest $request)
    {
        //Create a new Category record
        $category = new Category();
        $category->name = $request->name;
        if ($category->save()) {
            return new CategoryResource($category);
        }

    }


    /**
     * Display the specified resource.
     *
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //get specific Category record by id
        $cat = Category::findOrfail($id);
        return new CategoryResource($cat);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, $id)
    {
        //update a specific Category record by id
        $category = Category::findOrfail($id);
        $category->name = $request->name;
        if ($category->save()) {
            return new CategoryResource($category);
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //delete a specific Category record by id
        $cat = Category::findOrfail($id);
        if ($cat->delete()) {
            return new CategoryResource($cat);
        }
    }
}
