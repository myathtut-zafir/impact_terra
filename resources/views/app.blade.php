<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" value="{{ csrf_token() }}"/>
    <title>Dugro</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet" type="text/css">

    <!-- Favicons -->
    {{--<link href="{{ asset('assets/favicon/Favicon/favIcon_32x32.ico') }}" type="image/x-icon">--}}
    {{--<link href="{{ asset('assets/favicon/iOS/Icon-72@2x.png') }}" type="image/x-icon">--}}
    <link rel="shortcut icon" href={{url('/asset/media/favicon-16x16.png')}} />
    <!-- Bootstrap and Core CSS -->
    <link href="{{ asset('css/survey/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    {{--    <link href="{{ mix('css/app.css') }}" rel="stylesheet" type="text/css">--}}
    <link href="{{ mix('css/survey/app.css') }}" rel="stylesheet" type="text/css">
    {{--    <link href="{{ mix('css/di
    gitx.css') }}" rel="stylesheet" type="text/css">--}}


    {{--    <link href="{{asset('css/app.css')}}" rel="stylesheet" type="text/css">--}}
    {{--    <link href="{{asset('css/app.css')}}" rel="stylesheet" type="text/css">--}}

</head>
<body class="fadein" id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
<script async defer crossorigin="anonymous"
        src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.3&appId=354207985140763&autoLogAppEvents=1"></script>
<div id="fb-root"></div>
<!-- Wrapper -->
<div id="wrapper">

    <!-- Page Content -->
    <div id="page-content-wrapper">

        <!-- Content Section -->
        <section class="content-section">
            <div class="container">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-lg-offset-3 col-md-offset-3 col-sm-offset-3 col-xs-offset-0">
                    <div id="app">
                        <router-view></router-view>
                    </div>
                </div>
            </div>

        </section>

    </div><!-- End - Page Content -->

</div><!-- End - Wrapper -->

<script src="{{asset('js/frontend.js')}}"></script>
</body>
</html>