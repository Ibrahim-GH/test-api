<?php

namespace App\Http\Controllers;

use App\Http\Requests\Store\CreateStoreRequest;
use App\Http\Requests\Store\UpdateStoreRequest;
use App\Models\Store;
use App\Http\Resources\StoreResource;

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
        //delete a store childes by function boot() in model store then ...
        //delete a specific store record
        if ($store->delete()) {
            return new StoreResource($store);
        }
    }

}
