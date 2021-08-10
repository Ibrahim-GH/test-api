<?php

namespace App\Http\Controllers;


use App\Http\Requests\CreateteAttributeRequest;
use App\Http\Requests\UpdateAttributeRequest;
use App\Http\Resources\AttributeResource;
use App\Models\Attribute;
use Illuminate\Http\Request;

class AttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get retrieve all $attributes records
        $attributes = Attribute::paginate(10);
        return AttributeResource::collection($attributes);

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return CategoryResource
     */
    public function store(CreateteAttributeRequest $request)
    {
        //Create a new $attribute record
        $attribute = new Attribute();
        $attribute->name = $request->name;
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
    public function show($id)
    {
        //get specific Attribute record by id
        $attribute = Attribute::findOrfail($id);
        return new AttributeResource($attribute);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Category $category
     * @return AttributeResource
     */
    public function update(UpdateAttributeRequest $request, $id)
    {
        //update a specific Attribute record by id
        $attribute = Attribute::findOrfail($id);
        $attribute->name = $request->name;
        if ($attribute->save()) {
            return new AttributeResource($attribute);
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Category $category
     * @return AttributeResource
     */
    public function destroy($id)
    {
        //delete a specific Attribute record by id
        $attribute = Attribute::findOrfail($id);
        if ($attribute->delete()) {
            return new AttributeResource($attribute);
        }
    }
}
