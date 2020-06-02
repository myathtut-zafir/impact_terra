<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin</title>
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
    <script>
        WebFont.load({
            google: {
                "families": ["Poppins:300,400,500,600,700", "Roboto:300,400,500,600,700"]
            },
            active: function () {
                sessionStorage.fonts = true;
            }
        });
    </script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href={{asset("css/template-style/customize.css")}} rel="stylesheet" type="text/css"/>
    <!-- end::Customize Styles Sheet -->
    <link href="{{asset("vendors/custom/fullcalendar/fullcalendar.bundle.css")}}" rel="stylesheet" type="text/css"/>
    <!--begin:: Global Mandatory Vendors -->
    <link href="{{asset("vendors/general/perfect-scrollbar/css/perfect-scrollbar.css")}}" rel="stylesheet"
          type="text/css"/>
    <!--end:: Global Mandatory Vendors -->
    <!--begin:: Global Optional Vendors -->
    <link href="{{asset("vendors/general/tether/dist/css/tether.css")}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset("vendors/general/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css")}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset("vendors/general/bootstrap-datetime-picker/css/bootstrap-datetimepicker.css")}}"
          rel="stylesheet" type="text/css"/>
    <link href="{{asset("vendors/general/bootstrap-timepicker/css/bootstrap-timepicker.css")}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset("vendors/general/bootstrap-daterangepicker/daterangepicker.css")}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset("vendors/general/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.css")}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset("vendors/general/bootstrap-select/dist/css/bootstrap-select.css")}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset("vendors/general/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.css")}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset("vendors/general/select2/dist/css/select2.css")}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset("vendors/general/ion-rangeslider/css/ion.rangeSlider.css")}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset("vendors/general/nouislider/distribute/nouislider.css")}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset("vendors/general/owl.carousel/dist/assets/owl.carousel.css")}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset("vendors/general/owl.carousel/dist/assets/owl.theme.default.css")}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset("vendors/general/summernote/dist/summernote.css")}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset("vendors/general/bootstrap-markdown/css/bootstrap-markdown.min.css")}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset("vendors/general/animate.css/animate.css")}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset("vendors/general/morris.js/morris.css")}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset("vendors/general/sweetalert2/dist/sweetalert2.css")}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset("vendors/custom/vendors/line-awesome/css/line-awesome.css")}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset("vendors/custom/vendors/flaticon/flaticon.css")}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset("vendors/custom/vendors/flaticon2/flaticon.css")}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset("vendors/general/@fortawesome/fontawesome-free/css/all.min.css")}}" rel="stylesheet"
          type="text/css"/>

    <link href={{asset("vendors/general/dropzone/dist/dropzone.css")}} rel="stylesheet" type="text/css"/>
    <link href={{asset("vendors/general/toastr/build/toastr.css")}} rel="stylesheet" type="text/css"/>
    <link href={{asset("vendors/general/socicon/css/socicon.css")}} rel="stylesheet" type="text/css"/>
    <!--end:: Global Optional Vendors -->
    <link href={{asset("css/template-style/style.bundle.css")}} rel="stylesheet" type="text/css"/>
    <link href="{{ asset('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <!--end::Global Theme Styles -->
    <!-- begin::Customize Styles Sheet -->

    <link rel="shortcut icon" href={{url('/asset/media/favicon-16x16.png')}} />
    <meta name="csrf-token" value="{{ csrf_token() }}"/>
    @yield('style')
</head>
<body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed
	kt-header-mobile--fixed kt-subheader--fixed kt-subheader--enabled kt-subheader--solid kt-aside--enabled
	kt-aside--fixed kt-page--loading kt-scrolltop--off" style="background: white">
<div id="kt_header_mobile" class="kt-header-mobile  kt-header-mobile--fixed ">
    <div class="kt-header-mobile__logo">
        <a href="demo3/index.html">
            {{--<img alt="Logo" src="./assets/media/logos/logo-2-sm.png"/>--}}
        </a>
    </div>
    <div class="kt-header-mobile__toolbar">
        <button class="kt-header-mobile__toolbar-toggler kt-header-mobile__toolbar-toggler--left"
                id="kt_aside_mobile_toggler"><span></span></button>
        <button class="kt-header-mobile__toolbar-toggler" id="kt_header_mobile_toggler"><span></span></button>
        <button class="kt-header-mobile__toolbar-topbar-toggler" id="kt_header_mobile_topbar_toggler"><i
                    class="flaticon-more"></i></button>
    </div>
</div>
<div class="kt-grid kt-grid--hor kt-grid--root">
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">
        @include('admin.layouts.sidebar')
        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">
            @include('admin.layouts.menubar')
            <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
                @yield('content')
            </div>
            @include('admin.layouts.footer')
        </div>
    </div>

</div>

<div id="kt_scrolltop" class="kt-scrolltop">
    <i class="fa fa-arrow-up"></i>
</div>

@include('admin.layouts.javascript')
@yield('javascript')
</body>
</html>