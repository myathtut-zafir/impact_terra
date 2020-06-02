@extends('admin.layouts.master')
@section('content')
    <div>
        <!-- begin:: Content Head -->
        <div class="kt-subheader   kt-grid__item" id="kt_subheader">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">Product Price Create</h3>
                <span class="kt-subheader__separator kt-subheader__separator--v"></span>
            </div>
            <div class="kt-subheader__toolbar">
                <div class="kt-subheader__wrapper">
                </div>
            </div>
        </div>
        <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content" style="background-color: white">
            <div class="row">
                <div class="col-md-6 offset-md-1">
                    <form action="{{ route('product-price.insert') }}" method="post" class="kt-form">
                        @csrf
                        <div class="form-group">
                            <label for="market_name"> Select Market <span style="color: red">*</span></label>
                            <select class="form-control" id="market_name" name="market_name">
                                <option value="" selected>Please Select market</option>
                                @foreach($markets as $market)
                                    <option value="{{$market->id}}"
                                            @if(old('market_name')==$market->id) selected @endif>
                                        {{$market->market_name}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @if ($errors->has('market_name'))
                            <span class="text-danger">{{ $errors->first('market_name') }}</span>
                        @endif
                        <div class="form-group">
                            <label for="market_name"> Select Product <span style="color: red">*</span></label>
                            <select class="form-control" id="product_name" name="product_name">
                                <option value="" selected>Please Select Product</option>
                                @foreach($products as $product)
                                    <option value="{{$product->id}}"
                                            @if(old('product_name')==$product->id) selected @endif>
                                        {{$product->product_name}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @if ($errors->has('product_name'))
                            <span class="text-danger">{{ $errors->first('product_name') }}</span>
                        @endif
                        <div class="form-group">
                            <label for="date">Date</label>
                            <input type="date" class="form-control" id="date"
                                   aria-describedby="emailHelp" name="date">
                        </div>
                        @if ($errors->has('date'))
                            <span class="text-danger">{{ $errors->first('date') }}</span>
                        @endif

                        <button class="btn btn-primary">Save</button>
                    </form>
                </div>

            </div>


        </div>

        <!-- end:: Content Head -->
    </div>
@endsection
@section('javascript')
    <script>
        var prevScrollpos = window.pageYOffset;
        window.onscroll = function () {
            var currentScrollPos = window.pageYOffset;
            if (prevScrollpos > currentScrollPos) {
                document.getElementById("kt_header").style.top = "0px";
                document.getElementById("kt_subheader").style.top = "80px";
            } else {
                document.getElementById("kt_header").style.top = "-80px";
                document.getElementById("kt_subheader").style.top = "0px";
            }
            prevScrollpos = currentScrollPos;
        };
    </script>
@endsection