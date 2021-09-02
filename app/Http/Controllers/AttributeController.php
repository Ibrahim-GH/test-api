<?php

namespace App\Http\Controllers;


use App\Http\Requests\Attribute\CreateAttributeRequest;
use App\Http\Requests\Attribute\UpdateAttributeRequest;
use App\Http\Resources\Attribute\AttributeResource;
use App\Models\Attribute;


class AttributeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->authorizeResource(Attribute::class, 'attribute');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attributes = Attribute::paginate(10);
        return AttributeResource::collection($attributes);

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param CreateAttributeRequest $request
     * @return AttributeResource
     */
    public function store(CreateAttributeRequest $request)
    {

        //Create a new attribute record
        $attribute = new Attribute();
        $attribute->name = $request->name;
        $attribute->is_required = $request->isRequired;
        $attribute->category_id = $request->categoryId;

        $userId = $attribute->Category->store->user_id;

        if (auth()->id() == $userId) {

            if ($attribute->save()) {
                return new AttributeResource($attribute);
            }
        } else {
            abort(400, 'the Auth user do not store owner');
        }
    }


    /**
     * Display the specified resource.
     *
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function show(Attribute $attribute)
    {
        //get specific Attribute record by id  with parameters are belongs its
        $attribute->load('Parameters');
        return new AttributeResource($attribute);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Attribute $category
     * @return AttributeResource
     */
    public function update(UpdateAttributeRequest $request, Attribute $attribute)
    {
        $attribute->name = $request->name;
        $attribute->is_required = $request->isRequired;

        $userId = $attribute->Category->store->user_id;
        if (auth()->id() == $userId) {

            if ($attribute->save()) {
                return new AttributeResource($attribute);
            }
        } else {
            abort(400, 'the Auth user do not store owner');
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Attribute $category
     * @return AttributeResource
     */
    public function destroy(Attribute $attribute)
    {
        //delete a attribute by softDelete .
        $userId = $attribute->Category->store->user_id;

        if (auth()->id() == $userId) {

            if ($attribute->delete()) {
                return new AttributeResource($attribute);
            }
        } else {
            abort(400, 'the Auth user do not store owner');
        }

    }


    public function restore(Attribute $attribute)
    {
        $userId = $attribute->Category->store->user_id;

        if (auth()->id() == $userId) {

            $attribute->restore();
            return new AttributeResource($attribute);
        } else {
            abort(400, 'the Auth user do not store owner');
        }
    }
}
