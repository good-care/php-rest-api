<?php

use App\Http\Controllers\AssetsController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\Guard;
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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::middleware([Guard::class])->group(function (){
    Route::any('userdata', [UserController::class, 'getUserData']);
    Route::any('addToPortfolio', [AssetsController::class, 'addToPortfolio']);
    Route::any('getPortfolio', [AssetsController::class, 'getPortfolio']);
});

Route::any('assets/{type?}', [AssetsController::class, 'getAssets']);
Route::any('quotations/{assetId}', [AssetsController::class, 'getQuotations']);
Route::any('assetInfo/{assetId}', [AssetsController::class, 'getAssetInfo']);
Route::any('signup', [UserController::class, 'signUp']);
Route::any('signin', [UserController::class, 'signIn']);
