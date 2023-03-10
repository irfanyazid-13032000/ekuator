<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PaymentController;
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

Route::group(['middleware' => 'api','prefix' => 'auth'], function ($router) {
    Route::post('login', [AuthController::class,'login']);
    Route::post('logout', [AuthController::class,'logout']);
    Route::post('refresh', [AuthController::class,'refresh']);
    Route::post('register', [AuthController::class,'register']);
    Route::post('me', [AuthController::class,'me']);

});


Route::get('/products', [ProductController::class, 'index']); // get all products
Route::post('/products', [ProductController::class, 'store']); // create a new product
Route::get('/products/{uuid}', [ProductController::class, 'show']); // get a single product by UUID
Route::put('/products/{uuid}', [ProductController::class, 'update']); // update a product by UUID
Route::delete('/products/{uuid}', [ProductController::class, 'destroy']); // delete a product by UUID



Route::get('/payment/', [PaymentController::class, 'index']); // get all payment
Route::post('/payment', [PaymentController::class, 'store']); // create a new payment
Route::get('/payment/{uuid}', [PaymentController::class, 'show']); // get bunch of transactions by UUID
Route::delete('/payment/{uuid}', [PaymentController::class, 'destroy']); // delete a payment by UUID

Route::get('/transactions/{limit}/{sortBy}/{orderBy}', [TransactionController::class, 'index']); // get all transactions
Route::post('/transactions', [TransactionController::class, 'store']); // create a new transactions
Route::get('/transactions/{uuid}', [TransactionController::class, 'show']); // get a single transactions by UUID
Route::delete('/transactions/{uuid}', [TransactionController::class, 'destroy']); // delete a transactions by UUID




