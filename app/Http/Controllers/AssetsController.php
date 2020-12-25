<?php

namespace App\Http\Controllers;

use App\Models\GoodcareAsset;
use Illuminate\Http\Request;

class AssetsController extends Controller
{
    public function index(): \Illuminate\Http\JsonResponse
    {
        return response()->json(['assets' => GoodcareAsset::all()]);
    }
}
