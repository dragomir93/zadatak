<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\UserCheckoutController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderHistoryController;
use App\Http\Controllers\UsersController;
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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
  //  return $request->user();
//});

// Routes for web_shop db that do not require token 
include('shop/routes_without_token.php');


// Routes that require verified token
Route::group(['middleware' => [\App\Http\Middleware\TokenAuth::class]], function(){
    
    // Routes for Iecom2 db that require token 
    include('shop/routes_with_token.php');
    
});
