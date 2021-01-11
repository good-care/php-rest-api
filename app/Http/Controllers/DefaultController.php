<?php

namespace App\Http\Controllers;

use App\Exceptions\JsonAnswer;

class DefaultController extends Controller
{
    public function getDefaultJSONAnswer(): \Illuminate\Http\JsonResponse
    {
        return response()->json(
            new JsonAnswer(
                0,
                'Please use the correct requests to access API',
                null,
                null
            ),
            400);
    }
}