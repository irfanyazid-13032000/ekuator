<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;

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


Route::get('/products', [ProductController::class, 'index']); // get all products
Route::post('/products', [ProductController::class, 'store']); // create a new product
Route::get('/products/{uuid}', [ProductController::class, 'show']); // get a single product by UUID
Route::put('/products/{uuid}', [ProductController::class, 'update']); // update a product by UUID
Route::delete('/products/{uuid}', [ProductController::class, 'destroy']); // delete a product by UUID


Route::get('/transactions/{limit}/{sortBy}/{orderBy}', [TransactionController::class, 'index']); // get all transactions
Route::post('/transactions', [TransactionController::class, 'store']); // create a new transactions
Route::get('/transactions/{uuid}', [TransactionController::class, 'show']); // get a single transactions by UUID
Route::delete('/transactions/{uuid}', [TransactionController::class, 'destroy']); // delete a transactions by UUID




