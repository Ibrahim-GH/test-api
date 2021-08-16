<?php

namespace App\Http\Controllers;


use App\Http\Requests\Attribute\CreateAttributeRequest;
use App\Http\Requests\Attribute\UpdateAttributeRequest;
use App\Models\Attribute;
use App\Http\Resources\AttributeResource;


class AttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get retrieve attributes records
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
        $attribute->category_id = $request->categoryId;

        if ($attribute->save()) {
            return new AttributeResource($attribute);
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
        //get specific Attribute record by id
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
        //update a specific Attribute record by id
        $attribute->name = $request->name;

        if ($attribute->save()) {
            return new AttributeResource($attribute);
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
        //delete a specific Attribute record by id

        //delete a specific parameters are belongs to attribute
        $attribute->Parameters()->delete();

        if ($attribute->delete()) {
            return new AttributeResource($attribute);
        }
    }
}
