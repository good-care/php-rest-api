<?php

namespace App\Http\Controllers;

use App\Models\GoodcareAsset;

define('INDEX',0);
define('SHARE',1);
define('BOND',2);

class AssetsController extends Controller
{
    public function getAssets(): \Illuminate\Http\JsonResponse
    {
        return response()->json(['assets' => GoodcareAsset::all()]);
    }

    public function getIndexes(): \Illuminate\Http\JsonResponse
    {
        return response()->json(['assets' => GoodcareAsset::where('assettype',INDEX)->get()]);
    }

    public function getShares(): \Illuminate\Http\JsonResponse
    {
        return response()->json(['assets' => GoodcareAsset::where('assettype',SHARE)->get()]);
    }

    public function getBonds(): \Illuminate\Http\JsonResponse
    {
        return response()->json(['assets' => GoodcareAsset::where('assettype',BOND)->get()]);
    }

}