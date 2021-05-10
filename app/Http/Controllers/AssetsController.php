<?php

namespace App\Http\Controllers;

use App\Exceptions\JsonAnswer;
use App\Exceptions\ValidException;
use App\Models\GoodcareAsset;
use App\Models\GoodcareAssetsQuotation;
use App\Models\GoodcarePortfolio;
use App\Models\GoodcarePortfoliosAsset;
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

    public function getAssetInfo(Request $request, $assetId)
    {
        $assetInfo = GoodcareAsset::find($assetId);
        return response()->json(
            new JsonAnswer(
                1,
                "",

                $assetInfo,
                0
            )
        );
    }

    public function addToPortfolio(Request $request)
    {
        $content = json_decode($request->getContent());
        $userId = $request->input('userId');
        $assetId = $content->assetId;
        $purchaseDate = $content->purchaseDate;
        $cost = $content->cost;
        $number = $content->number;
        $name = $content->name;

        if (empty($assetId) || empty($purchaseDate) || $cost < 0 || $number < 0)
            return response()->json(
                new JsonAnswer(
                    0,
                    'Invalid addition info or assetId',
                    null,
                    0
                ));

        $asset = GoodcareAsset::where('id','=',$assetId)->first();
        if(is_null($asset))
            return response()->json(
                new JsonAnswer(
                    0,
                    "Can't find asset",
                    null,
                    0
                ));

        $portfolioAsset = new GoodcarePortfoliosAsset();
        $portfolioAsset->number = $number;
        $portfolioAsset->quotation = $cost;
        $portfolioAsset->moex_asset_id = $assetId;
        $portfolioAsset->date_time = $purchaseDate;
        $portfolioAsset->name = $name;

        $portfolio = GoodcarePortfolio::where('user_id','=',$userId)->first();
        $portfolioAsset->portfolio_id = $portfolio->id;

        $temp = GoodcareAssetsQuotation::where([
            ["moex_asset_id","=",$portfolioAsset->moex_asset_id],
            ["date_time","=",$portfolioAsset->date_time]
        ])->first();

        if(!empty($temp))
            $portfolioAsset->cost = $temp->quotation;

        if ($portfolioAsset->save()) {
            return response()->json(
                new JsonAnswer(
                    1,
                    'Asset added successfully',
                    null,
                    0
                ));
        } else
            return response()->json(
                new JsonAnswer(
                    0,
                    'can\'t add asset to portfolio',
                    null,
                    0
                ));
    }

    public function getPortfolio(Request $request){

        $userId = $request->input('userId');
        if (empty($userId))
            return response()->json(
                new JsonAnswer(
                    0,
                    'Please login first',
                    null,
                    0
                ));
        $portfolio = GoodcarePortfolio::where("user_id","=",$userId);
        if (empty($portfolio))
        return response()->json(
            new JsonAnswer(
                0,
                "Portfolio can't be founded",
                null,
                0
            )
        );

        $assets = GoodcarePortfoliosAsset::all();//where("portfolio_id","=",$portfolio->id)->orderBy('date_time')->get();
        return response()->json(
            new JsonAnswer(
                1,
                "",
                $assets,
                0
            )
        );
    }
}