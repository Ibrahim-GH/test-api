<?php

use App\Http\Controllers\AttributeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ParameterController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StoreController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('category', CategoryController::class);

*/

Route::apiResources([
    'store' => StoreController::class,
    'category' => CategoryController::class,
    'attribute' => AttributeController::class,
    'parameter' => ParameterController::class,
    'product' => ProductController::class,
]);

Route::get('store/categories/{id}', [StoreController::class, 'showStoreCategories']);
Route::get('store/products/{id}', [StoreController::class, 'ShowStoreProducts']);

Route::get('category/attributes/{id}', [CategoryController::class, 'showCategoryAttributes']);
Route::get('category/products/{id}', [CategoryController::class, 'showCategoryProducts']);

Route::get('attribute/parameters/{id}', [AttributeController::class, 'showAttributeParameters']);






