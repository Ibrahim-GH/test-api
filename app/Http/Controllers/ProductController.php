<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\CreateProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Http\Resources\Product\ProductResource;
use App\Models\Product;
use App\Models\ProductAttributeParameter;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->except('index', 'show');
        $this->authorizeResource(Product::class, 'product');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $perPage = request('perPage', 10);
        $products = Product::paginate($perPage);
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
        $user = Auth::user();
        if ($user->Store->id == $request->storeId) {
            $product = new Product();
            $file_name = $this->saveImage($request->photo, 'Storages/Products');

            $product->name = $request->name;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->quantity = $request->quantity;
            $product->category_id = $request->categoryId;
            $product->store_id = $request->storeId;
            $product->photo = isset($file_name) ? '/Storages/Products/' . $file_name : null;

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
        $userId = $product->Store->user_id;
        if (auth()->id() == $userId) {

            $product->name = $request->name;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->quantity = $request->quantity;

            foreach ($request->attributess as $attribute) {
                $productAttributeParameter = new ProductAttributeParameter();
                $productAttributeParameter->product_id = $product->id;
                $productAttributeParameter->attribute_id = $attribute['attributeId'];
                $productAttributeParameter->parameter_id = $attribute['parameterId'];

                $productAttributeParameter->save();
            }

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
        $userId = $product->Store->user_id;
        if (auth()->id() == $userId) {
            if ($product->delete()) {
                return new ProductResource($product);
            }
        } else {
            abort(400, 'the Auth user do not store owner');
        }
    }


    public function restore(Product $product)
    {
        $userId = $product->Store->user_id;
        if (auth()->id() != $userId) {
            abort(400, 'the Auth user do not store owner');
        } else {
            $product->restore();
            return new ProductResource($product);
        }
    }


    function saveImage($photo, $folder)
    {
        //save photo in folder
        $file_extension = $photo->getClientOriginalExtension();
        $file_name = time() . '.' . $file_extension;
        $path = $folder;
        $photo->move($path, $file_name);

        return $file_name;
    }

}
