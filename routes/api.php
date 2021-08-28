<?php

use App\Http\Controllers\AttributeController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ParameterController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\UserController;
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
    'order' => OrderController::class,
    'user' => UserController::class,
]);


Route::get('store/{store}/with-products', [StoreController::class, 'ShowStoreProducts']);
Route::get('category/{category}/with-products', [CategoryController::class, 'showCategoryProducts']);


######################### other routes for withTrashed then restore#################################

Route::get('user/{user}/restore', [UserController::class, 'restore']);

Route::get('store/{store}/restore', [StoreController::class, 'restore']);

Route::get('category/{category}/restore', [CategoryController::class, 'restore']);

Route::get('attribute/{attribute}/restore', [AttributeController::class, 'restore']);

Route::get('product/{product}/restore', [ProductController::class, 'restore']);

Route::get('parameter/{parameter}/restore', [ParameterController::class, 'restore']);

Route::get('order/{order}/restore', [OrderController::class, 'restore']);


############# Authentication and Generate tokens for users ##############

//register new user
Route::post('/register', [AuthenticationController::class, 'createAccount']);
//login user
Route::post('/login', [AuthenticationController::class, 'signin']);
//using middleware
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/profile', function (Request $request) {
        return auth()->user();
    });
    Route::post('/log-out', [AuthenticationController::class, 'logout']);
});



