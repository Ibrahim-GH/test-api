<?php

namespace App\Http\Controllers;


use App\Http\Requests\Category\CreateCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Models\Category;
use App\Http\Resources\Category\CategoryResource;
use App\Models\Order;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get retrieve categories records
        $categories = Category::paginate(10);
        return CategoryResource::collection($categories);

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param CreateCategoryRequest $request
     * @return CategoryResource
     */
    public function store(CreateCategoryRequest $request)
    {
        //create a new Category record
        $category = new Category();
        $category->name = $request->name;
        $category->store_id = $request->storeId;

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
    public function show(Category $category)
    {
        //get specific category record by id
        $category->load(['Attributes']);
        return new CategoryResource($category);
    }


    public function showCategoryProducts(Category $category)
    {
        //get specific Category record by id with Products are belongs its
        $category->load(['Products']);
        return new CategoryResource($category);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        //update a specific Category record by id
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
    public function destroy(Category $category)
    {
//        delete a category by softDelete .
//        you are not actually removed from your database.
//        Instead, a deleted_at attribute is set on the model and inserted into the database.
//        If a model has a non-null deleted_at value, the model has been soft deleted

        if ($category->delete()) {
            return new CategoryResource($category);
        }
    }

    //this query didn't find our deleted data. So time to make query with withTrashed.
    // So let's have a try
    public function withTrashed(Category $category)
    {
//        dd('$order');
        //get back our deleted category data using withTrashed().
        $category = Category::query()->where('id', $id)->withTrashed()->first();
        return new CategoryResource($category);
    }

    //retrieve this category data with norlam eloquent query
    public function restore()
    {
        $category = Category::query()->where('id', 1)->withTrashed()->first();
        $category->restore();
        return new CategoryResource($category);
    }
}
