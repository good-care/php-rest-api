<?php

use App\Http\Controllers\AssetsController;
use App\Http\Controllers\DefaultController;
use App\Http\Controllers\QuotationsController;
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


Route::any('assets/{type?}', [AssetsController::class, 'getAssets']);
Route::any('quotations/{assetId}', [AssetsController::class, 'getQuotations']);