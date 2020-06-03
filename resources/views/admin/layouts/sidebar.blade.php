<!-- begin:: Aside -->
<button class="kt-aside-close " id="kt_aside_close_btn"><i class="la la-close"></i></button>
<div class="kt-aside  kt-aside--fixed  kt-grid__item kt-grid kt-grid--desktop kt-grid--hor-desktop"
     id="kt_aside">
    <!-- begin:: Aside -->
    <div class="kt-aside__brand kt-grid__item  " id="kt_aside_brand">
        <div class="kt-aside__brand-logo">
            {{--<a href="{{ route("dashboard.index") }}">--}}
            {{--<img alt="Logo" src="{{url('/asset/media/mini-digitx.png')}}" style="width: 67px"/>--}}
            {{--</a>--}}
        </div>
    </div>
    <!-- end:: Aside -->

    <!-- begin:: Aside Menu -->
    <div class="kt-aside-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_aside_menu_wrapper">
        <div id="kt_aside_menu" class="kt-aside-menu  kt-aside-menu--dropdown " data-ktmenu-vertical="1"
             data-ktmenu-dropdown="1" data-ktmenu-scroll="0">
            <ul class="kt-menu__nav ">
                <li class="kt-menu__item  {{{ (activeFullUrl(route("market-price.index")) ? 'kt-menu__item--active' : '') }}}"
                    aria-haspopup="true"><a href="{{ route("market-price.index") }}" class="kt-menu__link "><i
                                class="kt-menu__link-icon flaticon2-dashboard"></i><span class="kt-menu__link-text"> Product</span></a>
                </li>
            </ul>
        </div>
    </div>

    <!-- end:: Aside Menu -->
</div>
<!-- end:: Aside -->