<?php

namespace App\Http\Controllers;

use App\Exceptions\JsonAnswer;
use App\Exceptions\ValidException;
use App\Models\GoodcareAsset;
use App\Models\GoodcareAssetsQuotation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

define('INDEX', 0);
define('SHARE', 1);
define('BOND', 2);
define('MAX_LIST_LENGTH', 100);

class AssetsController extends Controller
{
    public function getAssets(Request $request, $type = 'all'): \Illuminate\Http\JsonResponse
    {
        $offset = $this->getOffset($request);
        $size = $this->getSize($request);
        switch ($type) {
            case 'all':
                $assetList = GoodcareAsset::all()->sortBy('security_id');
                return response()->json(
                    new JsonAnswer(
                        1,
                        "",
                        array_values(
                            $assetList->skip($offset)->take($size)->toArray()
                        ),
                        sizeof($assetList)
                    ));
            case 'indexes':
                return $this->getAssetsByType(INDEX, $offset, $size);
            case 'shares':
                return $this->getAssetsByType(SHARE, $offset, $size);
            case 'bonds':
                return $this->getAssetsByType(BOND, $offset, $size);
        }
    }

    private function getAssetsByType(int $type, int $offset, int $size): \Illuminate\Http\JsonResponse
    {
        $assetList = GoodcareAsset::where('assettype', '=', $type)->orderBy('security_id')->get();
        return response()->json(
            new JsonAnswer(
                1,
                "",
                array_values(
                    $assetList->skip($offset)->take($size)->toArray()
                ),
                sizeof($assetList)
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
        if ($size > MAX_LIST_LENGTH) throw new ValidException("Size is too big! Max value is" . MAX_LIST_LENGTH);
        if ($size >= 0) return $size;
        return 0;
    }

    public function getQuotations(Request $request, $assetId)
    {
        $id = intval($assetId);
        $offset = $this->getOffset($request);
        $size = $this->getSize($request);
        $quotationList = GoodcareAssetsQuotation::where('moex_asset_id','=',$id)->orderBy('date_time')->get();

        return response()->json(
            new JsonAnswer(
                1,
                "",
                array_values(
                    $quotationList->skip($offset)->take($size)->toArray()
                ),
                sizeof($quotationList)
            )
        );
    }
}