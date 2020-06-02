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
            'price' => "20000",
            'market_name' => $this->market->market_name ?? "",
            'product_name' => $this->product->product_name ?? "",
        ];
    }
}
