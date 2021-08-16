<?php

namespace App\Http\Controllers;

use App\Http\Requests\Store\CreateStoreRequest;
use App\Http\Requests\Store\UpdateStoreRequest;
use App\Http\Resources\Store\StoreResource;
use App\Models\Store;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        //get retrieve stores records
        $stores = Store::paginate(10);
        return StoreResource::collection($stores);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param CreateStoreRequest $request
     * @return StoreResource
     */
    public function store(CreateStoreRequest $request)
    {
        //create a new store record
        $store = new Store();
        $store->name = $request->name;
        $store->address = $request->address;
        $store->phone_number = $request->phoneNumber;
        $store->user_id = $request->userId;

        if ($store->save()) {
            return new StoreResource($store);
        }
    }


    /**
     * Display the specified resource.
     *
     * @param \App\Models\Store $store
     * @return StoreResource
     */
    public function show(Store $store)
    {
        //get specific store record by id
        $store->load(['Categories']);
        return new StoreResource($store);
    }


    public function ShowStoreProducts(Store $store)
    {
        //get specific store record by id with Products are belongs its
        $store->load(['Products']);
        return new StoreResource($store);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Store $store
     * @return StoreResource
     */
    public function update(UpdateStoreRequest $request, Store $store)
    {
        //dd($request->all());
        //update a specific store record by id
        $store->name = $request->name;
        $store->address = $request->address;
        $store->phone_number = $request->phoneNumber;

        if ($store->save()) {
            return new StoreResource($store);
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Store $store
     * @return \Illuminate\Http\Response
     */
    public function destroy(Store $store)
    {
//        delete a store by softDelete .
//        you are not actually removed from your database.
//        Instead, a deleted_at attribute is set on the model and inserted into the database.
//        If a model has a non-null deleted_at value, the model has been soft deleted

        if ($store->delete()) {
            return new StoreResource($store);
        }
    }

    //this query didn't find our deleted data. So time to make query with withTrashed.
    // So let's have a try
    public function withTrashed()
    {
        //get back our deleted store data using withTrashed().
        $store = Store::query()->where('id', 1)->withTrashed()->first();
        return new StoreResource($store);
    }

    //retrieve this store data with norlam eloquent query
    public function restore()
    {
        $store = Store::query()->where('id', 1)->withTrashed()->first();
        $store->restore();
        return new StoreResource($store);
    }
}
