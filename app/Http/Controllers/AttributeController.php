<?php

namespace App\Http\Controllers;


use App\Http\Requests\Attribute\CreateAttributeRequest;
use App\Http\Requests\Attribute\UpdateAttributeRequest;
use App\Http\Resources\Attribute\AttributeResource;
use App\Models\Attribute;
use Illuminate\Support\Facades\Auth;


class AttributeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->authorizeResource(Attribute::class, 'attribute');
    }

//    protected function resourceAbilityMap()
//    {
//        $resourceAbilityMap = parent::resourceAbilityMap();
//
//        $resourceAbilityMap['restore'] = 'restore';
//
//        return $resourceAbilityMap;
//    }

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
        $attribute->is_required = $request->isRequired;
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
        $attribute->is_required = $request->isRequired;

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
//        delete a attribute by softDelete .
//        you are not actually removed from your database.
//        Instead, a deleted_at attribute is set on the model and inserted into the database.
//        If a model has a non-null deleted_at value, the model has been soft deleted

        if ($attribute->delete()) {
            return new AttributeResource($attribute);
        }
    }


    public function restore(Attribute $attribute)
    {
        //retrieve this attribute data with norlam eloquent query
        $attribute->onlyTrashed()->restore();

        return new AttributeResource($attribute);
    }
}
