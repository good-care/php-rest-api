<?php

use App\Models\GoodcareAsset;
use Illuminate\Http\Request;
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

Route::post('assets', 'App\Http\Controllers\AssetsController@getAssets');
Route::post('assets/indexes', 'App\Http\Controllers\AssetsController@getIndexes');
Route::post('assets/shares', 'App\Http\Controllers\AssetsController@getShares');
Route::post('assets/bonds', 'App\Http\Controllers\AssetsController@getBonds');