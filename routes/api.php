<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\CategoriesController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('products', [ProductsController::class, 'index']);
Route::get('products/{id}', [ProductsController::class, 'getById']);
Route::post('products', [ProductsController::class, 'store']);
Route::delete('products/{id}', [ProductsController::class, 'delete']);
Route::post('products/complete', [ProductsController::class, 'complete']);

Route::get('categories', [CategoriesController::class, 'index']);
Route::post('categories', [CategoriesController::class, 'store']);
Route::delete('categories/{id}', [CategoriesController::class, 'delete']);
Route::post('categories/complete', [CategoriesController::class, 'complete']);
