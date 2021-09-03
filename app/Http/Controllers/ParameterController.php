<?php

namespace App\Http\Controllers;


use App\Http\Requests\Parameter\CreateParameterRequest;
use App\Http\Requests\Parameter\UpdateParameterRequest;
use App\Http\Resources\Attribute\AttributeResource;
use App\Http\Resources\Parameter\ParameterResource;
use App\Models\Parameter;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


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
        /**
         * find store id and filter parameter based on that store id
         */
        /** @var User $user */
        $user = Auth::user();
        $storeId = $user->Store->id ?? null;
        if ($storeId) {
            $query = Parameter::query();
            $query->select(['parameters.*'])
                ->leftJoin('attributes', 'attribute_id', '=', 'parameters.attribute_id')
                ->leftJoin('categories', 'categories.id', '=', 'attributes.category_id')
                ->where('categories.store_id', $storeId);
        }

        $perPage = request('perPage', 10);
        $parameters = $query->paginate($perPage);

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

        $userId = $parameter->Attribute->Category->Store->user_id;

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
     * @param \App\Models\Parameter $parameter
     * @return ParameterResource
     */
    public function show(Parameter $parameter)
    {
        $userId = $parameter->Attribute->Category->Store->user_id;

        // check if parameter belong to user
        if (auth()->id() == $userId) {
            return new ParameterResource($parameter);
        } else {
            abort(400, 'the Auth user do not store owner');
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param UpdateParameterRequest $request
     * @param $id
     * @return AttributeResource
     */
    public function update(UpdateParameterRequest $request, Parameter $parameter)
    {
        $userId = $parameter->Attribute->Category->Store->user_id;

        if (auth()->id() == $userId) {
            $parameter->name = $request->name;

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
     * @param Parameter $parameter
     * @return ParameterResource
     */
    public
    function destroy(Parameter $parameter)
    {
        //delete a parameter by softDelete
        $userId = $parameter->Attribute->Category->Store->user_id;

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
        $userId = $parameter->Attribute->Category->Store->user_id;

        if (auth()->id() == $userId) {
            $parameter->restore();
            return new ParameterResource($parameter);
        } else {
            abort(400, 'the Auth user do not store owner');
        }
    }
}
