@extends('layouts.app')
@section('style')
    <style>
        .kt-login.kt-login--v3 .kt-login__wrapper .kt-login__container .kt-login__head .kt-login__title {
            text-align: center;
            font-size: 1.2rem;
            font-weight: 500;
            color: #464457
        }
    </style>
@endsection
@section('content')
    {{--login 3--}}
    <div class="kt-grid kt-grid--ver kt-grid--root">
        <div class="kt-grid kt-grid--hor kt-grid--root  kt-login kt-login--v3 kt-login--signin" id="kt_login">
            <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" style="background-color: white;">
                <div class="kt-grid__item kt-grid__item--fluid kt-login__wrapper">
                    <div class="kt-login__container">
                        <div class="kt-login__logo">
                            <a href="#">
                                <img src="{{url('/asset/media/logo.png')}}" style="width: 200px">
                            </a>
                        </div>
                        <div class="kt-login__signin">
                            <div class="kt-login__head">
                                <h3 class="kt-login__title">Sign In To Admin Pannel</h3>
                            </div>
                            <form class="kt-form" method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="input-group">
                                    <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                           type="text" placeholder="Email" name="email"
                                           autocomplete="off">
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="input-group">
                                    <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                           type="password" placeholder="Password" name="password">
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="kt-login__actions">
                                    <button type="submit" id="kt_login_signin_submit"
                                            class="btn btn-brand btn-elevate kt-login__btn-primary">Sign In
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
