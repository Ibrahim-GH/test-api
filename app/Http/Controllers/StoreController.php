<?php

namespace App\Http\Controllers;

use App\Http\Requests\Store\CreateStoreRequest;
use App\Http\Requests\Store\UpdateStoreRequest;
use App\Http\Resources\Store\StoreResource;
use App\Models\Store;
use Auth;

class StoreController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:sanctum')->except('index', 'show');
        $this->authorizeResource(Store::class, 'store');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $perPage = request('perPage', 10);
        $stores = Store::paginate($perPage);
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
        $store->load(['Categories']);
        return new StoreResource($store);
    }


    public function ShowStoreProducts(Store $store)
    {
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
        if (auth()->id() == $store->user_id) {
            $store->name = $request->name;
            $store->address = $request->address;
            $store->phone_number = $request->phoneNumber;

            if ($store->save()) {
                return new StoreResource($store);
            }
        } else {
            abort(400, 'the Auth user do not store owner ');
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
        if ($store->delete()) {
            return new StoreResource($store);
        }
    }


    public function restore(Store $store)
    {
        $store->restore();
        return new StoreResource($store);
    }
}
