<?php

namespace App\Http\Controllers;



use App\Http\Requests\Attribute\CreateAttributeRequest;
use App\Http\Requests\Attribute\UpdateAttributeRequest;
use App\Models\Attribute;
use App\Http\Resources\Attribute\AttributeParametersResource;
use App\Http\Resources\Attribute\AttributeResource;


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
        //get retrieve all attributes records
        $attributes = Attribute::paginate(10);
        return AttributeResource::collection($attributes);

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param CreateAttributeRequest $request
     * @return CategoryResource
     */
    public function store(CreateAttributeRequest $request)
    {
        //Create a new attribute record
        $attribute = new Attribute();
        $attribute->name = $request->name;
        $attribute->category_id = $request->category_id;
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



    public function showAttributeParameters($id)
    {
        //get specific Attribute record by id with parameters are belongs its
        $attribute = Attribute::findOrfail($id);
        $attribute->parameters;
        return new AttributeParametersResource($attribute);
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
        $attribute->category_id = $request->category_id;
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
