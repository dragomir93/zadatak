<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderHistoryController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/getAllArticles', [ArticleController::class, 'index']);
Route::get('/article/{id}', [ArticleController::class, 'show']);
Route::post('/userCheckout',[UserController::class,'store']);
Route::post('/addtoCart',[CartController::class,'store']);
Route::get('/getAllCart',[CartController::class,'index']);
Route::get('/getCartNumber',[CartController::class,'total']);
Route::delete('/deleteC art/{id}',[CartController::class,'delete']);
Route::delete('/dropAll',[CartController::class,'dropAll']);
Route::put('/update/cart/{id}',[CartController::class,'update']);
Route::get('/show/order/history',[OrderHistoryController::class,'index']);
Route::post('/add/order/history',[OrderHistoryController::class,'store']);

