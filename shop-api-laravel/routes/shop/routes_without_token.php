<?php
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\UserCheckoutController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderHistoryController;
use App\Http\Controllers\UsersController;

//Users
Route::post('user/login',[UsersController::class,'login']);
Route::get('/user/checkEmail/{email}', [UsersController::class,'checkEmail']);
Route::post('/user/registration',[UsersController::class,'registration']);

//Articles
Route::get('/getAllArticles', [ArticleController::class, 'index']);
Route::get('/article/{id}', [ArticleController::class, 'show']);
Route::get('/article/searchByName/{title}',[ArticleController::class,'searchByName']);

//Order history
Route::get('/show/order/history',[OrderHistoryController::class,'index']);