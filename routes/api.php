<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\DiscountController;

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

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::get('/orders/list', [OrderController::class, 'list']);
Route::post('/orders/create', [OrderController::class, 'create']);
Route::delete('/orders/{id}', [OrderController::class, 'destroy']);

Route::post('/discount/{orderId}',[DiscountController::class, 'discount']);
