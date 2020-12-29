<?php

namespace App\Http\Controllers;

use App\Exceptions\JsonAnswer;
use App\Exceptions\ValidException;
use App\Models\GoodcareAsset;
use Illuminate\Http\Request;

define('INDEX',0);
define('SHARE',1);
define('BOND',2);
define('MAX_LIST_LENGTH', 100);

class AssetsController extends Controller
{
    public function getAssets(Request $request, $type='all'): \Illuminate\Http\JsonResponse
    {
        $offset = $this->getOffset($request);
        $size = $this->getSize($request);
        switch ($type){
            case 'all':
                return response()->json(
                    new JsonAnswer(
                        1,
                        "",
                        GoodcareAsset::all()->skip($offset)->take($size)
                    ));
            case 'indexes': return $this->getAssetsByType(INDEX, $offset, $size);
            case 'shares': return $this->getAssetsByType(SHARE, $offset, $size);
            case 'bonds': return $this->getAssetsByType(BOND, $offset, $size);
        }
    }

    private function getAssetsByType (int $type, int $offset, int $size): \Illuminate\Http\JsonResponse
    {
        return response()->json(
            new JsonAnswer(
                1,
                "",
                GoodcareAsset::where('assettype',$type)->skip($offset)->take($size)->get()
            )
        );
    }

    /**
     * @param Request $request
     * @return int
     */
    private function getOffset(Request $request): int
    {
        $strOffset = $request->input('from');
        if (is_null($strOffset)) return 0;
        $offset = intval($strOffset);
        if ($offset >= 0) return $offset;
        return 0;
    }

    /**
     * @param Request $request
     * @return int
     * @throws ValidException
     */
    private function getSize(Request $request): int
    {
        $strSize = $request->input('size');
        if (is_null($strSize)) return MAX_LIST_LENGTH;
        $size = intval($strSize);
        if ($size > MAX_LIST_LENGTH) throw new ValidException("Size is too big! Max value is".MAX_LIST_LENGTH);
        if ($size >= 0) return $size;
        return 0;
    }
}