<?php

namespace App\Http\Controllers;


use App\Http\Requests\Attribute\CreateAttributeRequest;
use App\Http\Requests\Attribute\UpdateAttributeRequest;
use App\Http\Resources\Attribute\AttributeResource;
use App\Models\Attribute;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


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
        $query = Attribute::query();

        /**
         * find store id and filter attribute based on that store id
         */
        /** @var User $user */
        $user = Auth::user();
        $storeId = $user->Store->id ?? null;
        if ($storeId) {
            $query->select(['attributes.*'])
                ->leftJoin('categories', 'categories.id', '=', 'attributes.category_id')
                ->where('categories.store_id', $storeId);
        }

        $perPage = request('perPage', 10);
        $attributes = $query->paginate($perPage);

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
        $attribute = new Attribute();
        $attribute->name = $request->name;
        $attribute->is_required = $request->isRequired;
        $attribute->category_id = $request->categoryId;

        $userId = $attribute->Category->Store->user_id;

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
        $userId = $attribute->Category->Store->user_id;

        // check if attribute belong to user
        if (auth()->id() == $userId) {
            $attribute->load('Parameters');
            return new AttributeResource($attribute);
        } else {
            abort(400, 'the Auth user do not store owner');
        }
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
        $userId = $attribute->Category->store->user_id;

        if (auth()->id() == $userId) {
            $attribute->name = $request->name;
            $attribute->is_required = $request->isRequired;
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
        //delete a attribute by softDelete.
        $userId = $attribute->Category->Store->user_id;

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
