@extends('admin.layouts.master')
@section('style')
    <style>
        .fix-btn {
            color: white;
            margin-bottom: 12px;
        }
    </style>
@endsection
@section('content')
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">Product Price List</h3>
            <span class="kt-subheader__separator kt-subheader__separator--v"></span>
        </div>
        <div class="kt-subheader__toolbar">
            <div class="kt-subheader__wrapper">
            </div>
        </div>
    </div>
    <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content" style="background-color: #EDEEF4">
        <a href="{{ route("market-price.create") }}" class="btn btn-primary btn-text-color fix-btn">Add New</a>
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="card shadow mb-4">
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="table-responsive" style="font-size: 13px;">
                            <table class="table table-bordered dataTable myanmar-text" id="participants">
                                <thead>
                                <tr>
                                    <td>ID</td>
                                    <td>date</td>
                                    <td>Market Name</td>
                                    <td>Product Name</td>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($productPrices as $productPrice)
                                    <tr>
                                        <td>{{$productPrice->id}}</td>
                                        <td>{{$productPrice->date_price}}</td>
                                        <td>{{$productPrice->market->market_name ?? ""}}</td>
                                        <td>{{$productPrice->product->product_name ?? ""}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                                {{$productPrices->render()}}
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
