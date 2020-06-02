<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\APIResponser;
use App\Http\Resources\ProductPriceCollection;
use App\Http\Resources\ProductPriceMyanmarCollection;
use App\Models\ProductPrice;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class ProductPriceApiController extends Controller
{
    use APIResponser;

    /**
     * @SWG\Get(
     *   path="/api/market-price?date=2020-05-31?language=mm",
     *   summary="market prices with date",
     *   @SWG\Response(response=200, description="successful operation"),
     * )
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    function index(Request $request)
    {
        $requestedDate = $request->date ?? Carbon::today('Asia/Rangoon')->toDateString();
        $productPrice = ProductPrice::with(['market', 'product'])
            ->where('date_price', $requestedDate)
            ->paginate(20);

        if ($request->language === "mm") {
            return response()->json(new ProductPriceMyanmarCollection($this->cacheCompose($request, $requestedDate, $productPrice)));
        }

        return response()->json(new ProductPriceCollection($this->cacheCompose($request, $requestedDate, $productPrice)));
    }

    /**
     * @SWG\Post(
     *   path="/api/market-price",
     *   summary="Insert market price",
     *   @SWG\Response(response=200, description="successful operation"),
     *   @SWG\Response(response=400, description="fail"),
     *		@SWG\Parameter(
     *          name="market-prices",
     *          in="path",
     *          type="string"
     *      ),
     * )
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    function store(Request $request)
    {
        $data = $request->all();

        if ($data['market_id'] != null || $data['product_id'] != null) {
            return $this->exceptionResponse('product_id or market_id should not be null ', 400);
        }

        $productPrice = new ProductPrice();
        $productPrice->date_price = isset($data['date']) && $data['date'] != null ? $data['date'] : Carbon::today('Asia/Rangoon')->toDateString();
        $productPrice->market_id = $data['market_id'];
        $productPrice->product_id = $data['product_id'];
        $productPrice->save();

        return $this->respondSuccessMsgOnly('success Product');
    }

    /**
     * @param Request $request
     * @param $requestedDate
     * @param $productPrice
     * @return mixed
     */
    private function cacheCompose(Request $request, $requestedDate, $productPrice)
    {
        $cacheKey = $requestedDate . '-' . $request->language ?? "en";
        if (Cache::has($cacheKey)) {
            Log::info('cache', ['here' => $cacheKey]);
            return Cache::get($cacheKey);
        } else {
            Log::info('cache', ['nope' => $cacheKey]);
            Cache::put($cacheKey, $productPrice, 20);
            return $productPrice;
        }
    }
}
