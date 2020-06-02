<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductPriceMyanamrResource extends JsonResource
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
            'market_name' => $this->market->market_name_mm ?? "",
            'product_name' => $this->product->product_name_mm ?? "",
        ];
    }
}
