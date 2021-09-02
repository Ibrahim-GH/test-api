<?php

namespace App\Http\Controllers;


use App\Http\Requests\Parameter\CreateParameterRequest;
use App\Http\Requests\Parameter\UpdateParameterRequest;
use App\Http\Resources\Attribute\AttributeResource;
use App\Http\Resources\Parameter\ParameterResource;
use App\Models\Attribute;
use App\Models\Category;
use App\Models\Parameter;
use App\Models\Store;


class ParameterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->authorizeResource(Parameter::class, 'parameter');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
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
        $parameter = new Parameter();
        $parameter->name = $request->name;
        $parameter->attribute_id = $request->attributeId;

        $userId =   $parameter->Attribute->Category->store->user_id;

        if (auth()->id() == $userId) {

            if ($parameter->save()) {
                return new ParameterResource($parameter);
            }
        } else {
            abort(400, 'the Auth user do not store owner');
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
        $parameter = Parameter::findOrfail($id);
        $parameter->name = $request->name;

        $userId =   $parameter->Attribute->Category->store->user_id;
        if (auth()->id() == $userId) {

            if ($parameter->save()) {
                return new ParameterResource($parameter);
            }
        } else {
            abort(400, 'the Auth user do not store owner');
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Category $category
     * @return AttributeResource
     */
    public function destroy(Parameter $parameter)
    {
        //delete a parameter by softDelete .
        $userId =   $parameter->Attribute->Category->store->user_id;

        if (auth()->id() == $userId) {

            if ($parameter->delete()) {
                return new ParameterResource($parameter);
            }
        } else {
            abort(400, 'the Auth user do not store owner');
        }
    }


    public function restore(Parameter $parameter)
    {

        $userId =   $parameter->Attribute->Category->store->user_id;

        if (auth()->id() == $userId) {
            $parameter->restore();
            return new ParameterResource($parameter);
        } else {
            abort(400, 'the Auth user do not store owner');
        }
    }
}
