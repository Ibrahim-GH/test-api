<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\CreateCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Http\Resources\Category\CategoryResource;
use App\Models\Category;
use App\Models\Store;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->except('index', 'show');
        $this->authorizeResource(Category::class, 'category');
    }

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
        $category = new Category();
        $category->name = $request->name;
        $category->store_id = $request->storeId;

        $store = Store::find($request->storeId);

        if (auth()->id() == $store->user->id) {
            if ($category->save()) {
                return new CategoryResource($category);
            }
        } else {
            abort(400, 'the Auth user do not store owner ');
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
        //get specific category record by id with attributes are belongs its
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
        $category->name = $request->name;

        $store = Store::find($category->store_id);

        if (auth()->id() == $store->user->id) {
            if ($category->save()) {
                return new CategoryResource($category);
            }
        } else {
            abort(400, 'the Auth user do not store owner ');
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
        //delete a category by softDelete
        $store = Store::find($category->store_id);

        if (auth()->id() == $store->user->id) {
            if ($category->delete()) {

                return new CategoryResource($category);

            } else {
                abort(400, 'the Auth user do not store owner ');
            }
        }
    }

    public
    function restore(Category $category)
    {
        $store = Store::find($category->store_id);

        if (auth()->id() == $store->user->id) {
            $category->restore();
        } else {
            abort(400, 'the Auth user do not store owner ');
        }
        return new CategoryResource($category);
    }
}
