<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\CreateProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Models\Product;
use App\Http\Resources\Product\ProductResource;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        //get retrieve all Products records
        $products = Product::paginate(10);
        return ProductResource::collection($products);

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param CreateProductRequest $request
     * @return ProductResource
     */
    public function store(CreateProductRequest $request)
    {
        //Create a new product record
        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->category_id = $request->category_id;
        $product->store_id = $request->store_id;
        if ($product->save()) {
            return new ProductResource($product);
        }

    }


    /**
     * Display the specified resource.
     *
     * @param \App\Models\Category $category
     * @return ProductResource
     */
    public function show($id)
    {
        //get specific product record by id
        $product = Product::findOrfail($id);
        return new ProductResource($product);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Product $product
     * @return ProductResource
     */
    public function update(UpdateProductRequest $request, $id)
    {
        //update a specific product record by id
        $product = Product::findOrfail($id);
        $product->name = $request->name;
        $product->description = $request->description;
        $product->category_id = $request->category_id;
        $product->store_id = $request->store_id;
        if ($product->save()) {
            return new ProductResource($product);
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //delete a specific product record by id
        $product = Product::findOrfail($id);
        if ($product->delete()) {
            return new ProductResource($product);
        }
    }
}
