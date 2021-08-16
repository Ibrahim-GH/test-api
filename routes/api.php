<?php

use App\Http\Controllers\AttributeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ParameterController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StoreController;
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

Route::apiResources([
    'store' => StoreController::class,
    'category' => CategoryController::class,
    'attribute' => AttributeController::class,
    'parameter' => ParameterController::class,
    'product' => ProductController::class,
]);

Route::get('store/{store}/with-products', [StoreController::class, 'ShowStoreProducts']);
Route::get('category/{category}/with-products', [CategoryController::class, 'showCategoryProducts']);


######################### other routes for withTrashed then restore#################################

//Route::get('user/{user}/withTrashed', [UserController::class, 'withTrashed']);
//Route::get('user/{user}/restore', [UserController::class, 'restore']);

Route::get('store/{store}/withTrashed', [StoreController::class, 'withTrashed']);
Route::get('store/{store}/restore', [StoreController::class, 'restore']);

Route::get('category/{category}/withTrashed', [CategoryController::class, 'withTrashed']);
Route::get('category/{category}/restore', [CategoryController::class, 'restore']);

Route::get('attribute/{attribute}/withTrashed', [AttributeController::class, 'withTrashed']);
Route::get('attribute/{attribute}/restore', [AttributeController::class, 'restore']);

Route::get('product/{product}/withTrashed', [ProductController::class, 'withTrashed']);
Route::get('product/{product}/restore', [ProductController::class, 'restore']);

Route::get('parameter/{parameter}/withTrashed', [ParameterController::class, 'withTrashed']);
Route::get('parameter/{parameter}/restore', [ParameterController::class, 'restore']);






