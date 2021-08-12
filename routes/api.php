<?php

use App\Http\Controllers\AttributeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ParameterController;
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
    'category' => CategoryController::class,
    'attribute' => AttributeController::class,
    'parameter' => ParameterController::class,
]);

Route::get('category/showCategoryAttributes/{id}', [CategoryController::class,'showCategoryAttributes']);

Route::get('attribute/showAttributeParameters/{id}', [AttributeController::class,'showAttributeParameters']);






