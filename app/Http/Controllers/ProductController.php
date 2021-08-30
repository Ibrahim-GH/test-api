<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\CreateProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Http\Resources\Product\ProductResource;
use App\Models\Product;
use App\Models\ProductAttributeParameter;
use App\Models\Store;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->except('index', 'show');
//        dd(auth()->id());
        $this->authorizeResource(Product::class, 'product');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {

        //get retrieve Products records
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

        $file_name = $this->saveImage($request->photo, 'Storages/Products');

        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->category_id = $request->categoryId;
        $product->store_id = $request->storeId;
        $product->photo = isset($file_name) ? '/Storages/Products/' . $file_name : null;

        $store = Store::find($request->storeId);
        if (auth()->id() == $store->user->id) {
            if ($product->save()) {

                foreach ($request->attributess as $attribute) {
                    $productAttributeParameter = new ProductAttributeParameter();
                    $productAttributeParameter->product_id = $product->id;
                    $productAttributeParameter->attribute_id = $attribute['attributeId'];
                    $productAttributeParameter->parameter_id = $attribute['parameterId'];

                    $productAttributeParameter->save();
                }
                return new ProductResource($product);
            }
        } else {
            abort(400, 'the Auth user do not store owner');
        }
    }


    /**
     * Display the specified resource.
     *
     * @param \App\Models\Product $product
     * @return ProductResource
     */
    public function show(Product $product)
    {
        //get specific product record by id
        return new ProductResource($product);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Product $product
     * @return ProductResource
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        //update a specific product record by id
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->quantity = $request->quantity;

        //in state: attribute and parameter do not exist in request do not save in foreach
        if ($request->attributess !== null) {
            //in state add new attribute to category :
            // add attribute and parameter value  to product
            foreach ($request->attributess as $attribute) {
                $productAttributeParameter = new ProductAttributeParameter();
                $productAttributeParameter->product_id = $product->id;
                $productAttributeParameter->attribute_id = $attribute['attributeId'];
                $productAttributeParameter->parameter_id = $attribute['parameterId'];

                $productAttributeParameter->save();
            }
        }

        $store = Store::find($product->store_id);
        if (auth()->id() == $store->user->id) {

            if ($product->save()) {
                return new ProductResource($product);
            }
        } else {
            abort(400, 'the Auth user do not store owner');
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
//        delete a product by softDelete .
//        you are not actually removed from your database.
//        Instead, a deleted_at attribute is set on the model and inserted into the database.
//        If a model has a non-null deleted_at value, the model has been soft deleted

        $store = Store::find($product->store_id);
        if (auth()->id() == $store->user->id) {

            if ($product->delete()) {
                return new ProductResource($product);
            }
        } else {
            abort(400, 'the Auth user do not store owner');
        }
    }


    public function restore(Product $product)
    {
        //retrieve this product data with norlam eloquent query

        $store = Store::find($product->store_id);
        if (auth()->id() == $store->user->id) {
            $product->restore();
        } else {
            abort(400, 'the Auth user do not store owner');
        }
        return new ProductResource($product);
    }


    function saveImage($photo,$folder){
        //save photo in folder
        $file_extension = $photo -> getClientOriginalExtension();
        $file_name = time().'.'.$file_extension;
        $path = $folder;
        $photo -> move($path,$file_name);

        return $file_name;
    }

}
