<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductPriceResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'date_price' => $this->date_price ?? "",
            'price' => $this->price ?? "",
            'market_name' => $this->composeMarketName($request['language']),
            'product_name' => $this->composeProductName($request['language']),
        ];
    }

    function composeMarketName($language)
    {
        return $language === "mm" ? $this->market->market_name_mm : $this->market->market_name ?? "";
    }

    function composeProductName($language)
    {
        return $language === "mm" ? $this->product->product_name_mm ?? "" : $this->product->product_name ?? "";
    }
}
