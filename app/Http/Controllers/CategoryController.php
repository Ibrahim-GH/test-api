<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\CreateCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Http\Resources\Category\CategoryResource;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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
        $perPage = request('perPage', 10);
        $categories = Category::paginate($perPage);
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
        $user = Auth::user();
        if ($user->Store->id == $request->storeId) {
            $category = new Category();
            $category->name = $request->name;
            $category->store_id = $request->storeId;

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
        $category->load(['Attributes']);
        return new CategoryResource($category);
    }


    public function showCategoryProducts(Category $category)
    {
        $category->load(['Products']);
        return new CategoryResource($category);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCategoryRequest $request
     * @param Category $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        /** @var User $user */
        $user = Auth::user();
        if ($user->Store->id == $category->store_id) {
            $category->name = $request->name;
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
        /** @var User $user */
        $user = Auth::user();
        if ($user->Store->id == $category->store_id) {
            if ($category->delete()) {
                return new CategoryResource($category);
            }
        } else {
            abort(400, 'the Auth user do not store owner ');
        }
    }

    public function restore(Category $category)
    {
        /** @var User $user */
        $user = Auth::user();
        if ($user->Store->id != $category->store_id) {
            abort(400, 'the Auth user do not store owner ');
        } else {
            $category->restore();
            return new CategoryResource($category);
        }
    }
}
