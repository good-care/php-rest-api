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

Route::post('assets', 'App\Http\Controllers\AssetsController@index');

//Route::post('actives', function () {
////    return response()->json(['message' => 'actives post request'], 200);
//    return response()->json(GoodcareAsset::all(),200);
//});