<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductPriceRequest;
use App\Models\Market;
use App\Models\Product;
use App\Models\ProductPrice;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProductPriceController extends Controller
{
    function index()
    {
        $productPrices = ProductPrice::paginate(5);

        return view('admin.product-price.index', compact('productPrices'));
    }

    function create()
    {
        $markets = Market::all();
        $products = Product::all();

        return view('admin.product-price.create', compact('markets', 'products'));
    }

    function store(ProductPriceRequest $request)
    {
        $data = $request->all();

        $productPrice = new ProductPrice();
        $productPrice->date_price = isset($data['date']) && $data['date'] != null ? $data['date'] : Carbon::today('Asia/Rangoon')->toDateString();
        $productPrice->market_id = $data['market_name'];
        $productPrice->product_id = $data['product_name'];
        $productPrice->price = $data['price'];

        $productPrice->save();

        return redirect()->back();
    }
}
