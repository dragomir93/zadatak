<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\UserCheckoutController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderHistoryController;
use App\Http\Controllers\UsersController;

//Articles

Route::delete('/delete/article/{id}',[ArticleController::class,'delete']);
Route::post('/add/article',[ArticleController::class,'store']);
Route::put('/update/article/{id}',[ArticleController::class,'update']);

//User checkout
Route::post('/userCheckout',[UserCheckoutController::class,'store']);
Route::get('/get/userCheckout',[UserCheckoutController::class,'getUserCheckout']);
Route::get('/userCheckout/{id}',[UserCheckoutController::class,'getUserCheckoutById']);

//Users
Route::get('/get/all/users',[UsersController::class,'index']);
Route::get('/get/users/{id}',[UsersController::class,'show']);
Route::get('/getUserNumber',[UsersController::class,'total']);
Route::put('/update/user/{id}',[UsersController::class,'update']);
Route::delete('/user/delete/{id}',[UsersController::class,'delete']);
Route::post('/user/loginWithToken', [UsersController::class,'loginWithToken']);
Route::post('/user/logout',[UsersController::class,'logout']);
Route::post('/user/resetPassword', [UsersController::class,'resetPassword']);

//Cart
Route::post('/addtoCart',[CartController::class,'store']);
Route::get('/getAllCart',[CartController::class,'index']);
Route::get('/get/cart/{id}',[CartController::class,'show']);
Route::get('/getCartNumber',[CartController::class,'total']);
Route::delete('/deleteCart/{id}',[CartController::class,'delete']);
Route::delete('/dropAll',[CartController::class,'dropAll']);
Route::put('/update/cart/{id}',[CartController::class,'update']);

//Order History
Route::post('/add/order/history',[OrderHistoryController::class,'store']);
Route::get('/show/order/history/user/{id}',[OrderHistoryController::class,'show']);