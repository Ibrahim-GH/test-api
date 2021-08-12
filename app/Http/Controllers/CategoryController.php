<?php

namespace App\Http\Controllers;


use App\Http\Requests\Category\CreateCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Models\Category;
use App\Http\Resources\Category\CategoryAttributesResource;
use App\Http\Resources\Category\CategoryResource;
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
        $category = Category::findOrfail($id);
        return new CategoryResource($category);
    }


    public function showCategoryAttributes($id)
    {
        //get specific Category record by id with Attributes are belongs its
        $category = Category::findOrfail($id);
        $category->Attributes;
        return new CategoryAttributesResource($category);
    }



    /*
        public function showCategoryProducts($id)
        {
            //get specific Category record by id with Products are belongs its
            $category = Category::findOrfail($id);
            $category->Products;
            return new CategoryResource($category);
        }
      */


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
        $category = Category::findOrfail($id);

        //delete a specific Attributes are belongs to Category
        $category->Attributes()->delete();

        //delete a specific Products are belongs to Category record by id
        // $category->Products()->delete();

        if ($category->delete()) {
            return new CategoryResource($category);
        }
    }
}
