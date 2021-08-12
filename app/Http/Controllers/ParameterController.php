<?php

namespace App\Http\Controllers;


use App\Http\Requests\Parameter\CreateParameterRequest;
use App\Http\Requests\Parameter\UpdateParameterRequest;
use App\Models\Parameter;
use App\Http\Resources\Parameter\ParameterResource;
use Illuminate\Http\Request;

class ParameterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        //get retrieve all parameters records
        $parameters = Parameter::paginate(10);
        return ParameterResource::collection($parameters);

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param CreateParameterRequest $request
     * @return ParameterResource
     */
    public function store(CreateParameterRequest $request)
    {
        //Create a new parameter record
        $parameter = new Parameter();
        $parameter->name = $request->name;
        $parameter->attribute_id = $request->attribute_id;
        if ($parameter->save()) {
            return new ParameterResource($parameter);
        }

    }


    /**
     * Display the specified resource.
     *
     * @param \App\Models\Category $category
     * @return ParameterResource
     */
    public function show($id)
    {
        //get specific parameter record by id
        $parameter = Parameter::findOrfail($id);
        return new ParameterResource($parameter);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param UpdateParameterRequest $request
     * @param $id
     * @return AttributeResource
     */
    public function update(UpdateParameterRequest $request, $id)
    {
        //update a specific Attribute record by id
        $parameter = Parameter::findOrfail($id);
        $parameter->name = $request->name;
        $parameter->attribute_id = $request->attribute_id;
        if ($parameter->save()) {
            return new ParameterResource($parameter);
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
        //delete a specific parameter record by id
        $parameter = Parameter::findOrfail($id);
        if ($parameter->delete()) {
            return new ParameterResource($parameter);
        }
    }
}
