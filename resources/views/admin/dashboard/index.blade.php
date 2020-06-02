@extends('admin.layouts.master')
@section('content')
    <div id="app">
        <h1>Hello</h1>
    </div>
@endsection
@section('javascript')
    {{-- <script>
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
    </script> --}}
@endsection