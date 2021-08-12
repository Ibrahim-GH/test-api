<?php

namespace App\Http\Controllers;

use App\Http\Requests\Store\CreateStoreRequest;
use App\Http\Requests\Store\UpdateStoreRequest;
use App\Models\Store;
use App\Http\Resources\Store\StoreCategoriesResource;
use App\Http\Resources\Store\StoreProductsResource;
use App\Http\Resources\Store\StoreResource;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        //get retrieve all stores records
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
        //Create a new store record
        $store = new Store();
        $store->name = $request->name;
        $store->address = $request->address;
        $store->phone_number = $request->phone_number;
        //$store->user_id = $request->user_id;
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
    public function show($id)
    {
        //get specific store record by id
        $store = Store::findOrfail($id);
        return new StoreResource($store);
    }


    public function showStoreCategories($id)
    {
        //get specific store record by id with category are belongs its
        $store = Store::findOrfail($id);
        $store->Categories;
        return new StoreCategoriesResource($store);
    }


    public function ShowStoreProducts($id)
    {
        //get specific store record by id with Products are belongs its
        $store = Store::findOrfail($id);
        $store->Products;
        return new StoreProductsResource($store);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Store $store
     * @return StoreResource
     */
    public function update(UpdateStoreRequest $request, $id)
    {
        //update a specific store record by id
        $store = Store::findOrfail($id);
        $store->name = $request->name;
        $store->address = $request->address;
        $store->phone_number = $request->phone_number;
        //$store->user_id = $request->user_id;
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
    public function destroy($id)
    {
        //delete a specific store record by id
        $store = Store::findOrfail($id);

        //delete a specific categories are belongs to store
        $store->Categories()->delete();

        //delete a specific Products are belongs to store
        $store->Products()->delete();

        if ($store->delete()) {
            return new StoreResource($store);
        }
    }
}
