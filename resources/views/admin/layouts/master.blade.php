<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="title" content="오타와한인교회 (Ottawa Korean Community Church)">
        <meta name="description" content="오타와한인교회는 1976년 11월 21에 설립된 복음주의 독립교회입니다. 오타와한인교회 비젼: 하나님의 영광스런 이름을 드높이 찬미하기 위하여 (Glory to GOD) 예수 그리스도의 성숙한 제자가 되고 (Mature Disciple) 사랑의 공동체를 이루며 (Loving Community) 세상에 널리 복음을 전한다(Mission)">
        <meta name="keyword" content="오타와한인교회, 오타와, 한인교회, 교회, Ottawa, Korean, Korean Church, Ottawa Church">
        <meta name="author" content="오타와한인교회 (Ottawa Korean Community Church)">
        {{-- CSRF Token --}}
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Application Name') }}</title>
        {{-- Favicon --}}
        <link rel="icon" href="{{ asset('images/favicon.ico') }}">

        {{-- Font Awesome 5.0.13 --}}
        <link href="{{ asset('css/fontawesome/css/fontawesome-all.min.css') }}" rel="stylesheet" type="text/css">
        {{-- Korean Fonts : <TODO>나중에 사용해보고 적절한 폰트 2-3가지만 고를 예정임</TODO> --}}
        <link href="https://fonts.googleapis.com/css?family=Gaegu:300,400,700|Gamja+Flower|Nanum+Gothic:400,800|Nanum+Myeongjo:400,800|Roboto:300,400,400i,500,500i,700,700i,900,900i|Montserrat:400,700|Droid+Serif:400,700,400italic,700italic" rel="stylesheet" type='text/css'>
        <link href='https://cdn.rawgit.com/young-ha/webfont-archive/master/css/Youth.css' rel='stylesheet' type='text/css'>
        {{-- toastr is a Javascript library for non-blocking notifications. jQuery is required. https://github.com/CodeSeven/toastr --}}
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
        {{-- Basic Styles --}}
        <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('css/admin.css') }}" rel="stylesheet" type="text/css">
        {{-- for additional styles --}}
        @yield('styles')
    </head>
    <body>

        @include('admin.layouts.header')
        @include('admin.layouts.side')
        @include('admin.layouts.footer')

        {{-- Custom JS --}}
        <script src="{{ asset('js/app.js') }}"></script>
        {{-- Using Laravel localization with JavaScript and VueJS https://medium.com/@serhii.matrunchyk/using-laravel-localization-with-javascript-and-vuejs-23064d0c210e --}}
        <script src="{{ asset('js/lang.js') }}"></script>
        <script src="{{ asset('js/messages.js') }}" defer></script>
        <script src="{{ asset('js/admin.js') }}" defer></script>
        {{-- jQuery idle timer --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-idletimer/1.0.0/idle-timer.min.js"></script> 
        {{-- CSRF Token --}}
        <script>window.Laravel = { csrfToken: "{{ csrf_token() }}" }</script>
        {{-- toastr is a Javascript library for non-blocking notifications. jQuery is required. https://github.com/CodeSeven/toastr --}}
        <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

        {{-- for additional scripts --}}
        @yield('scripts')

        <script>
            // Session timeout
            $.idleTimer( '{{ config('session.lifetime') }}' * 60 * 1000 );
            $( document ).bind( "idle.idleTimer", function(event, elem, obj){
                window.location.href = '{{ url('/') }}';
            }); 

            // Get roles for current user
            var USER_ROLES = '';
            var USER_ID = '';
            @auth
                USER_ID = "{{ Auth::user()->id }}";
                USER_ROLES = "{{ Auth::user()->privilege }}";
            @endauth

            // Check if URL includes menu string
            function menu( $menuStr = '/' ) {
                return window.location.pathname.includes( $menuStr );
            }

            // Callback: create side menu
            var getSideMenuItem = function ( itemData ) {
                var item = $("<li>").append(
                    $("<a>", {
                        'href': itemData.sub_menu ? ('#' + itemData.text) : (itemData.route ? itemData.route : '#' + itemData.text),
                        'html': '<i class="fas fa-fw ' + itemData.icon + ' mr-1"></i>' + itemData.text,
                        'data-toggle': (itemData.sub_menu) ? 'collapse' : '',
                    })
                );
                if ( itemData.sub_menu ) {
                    var subList = $("<ul>").attr('id', itemData.text).attr('aria-expanded', false).addClass('list-unstyled collapse');
                    itemData.isOpened ? subList.addClass('show') : '';
                    $.each( itemData.sub_menu, function ( index, submenu ) {
                        subList.append( getSideMenuItem( submenu ) );
                    });
                    item.append(subList);
                } else {
                    if (itemData.route) {
                        urlRoute = itemData.route.replace(/^https?:\/\//,'');
                        urlPage = location.href.replace(/^https?:\/\//,'');
                        if (urlRoute == urlPage) {
                            item.addClass('active');
                        }
                    }
                    if(!itemData.roles.includes(USER_ROLES)) {
                        item.hide();
                    }
                }
                return item;
            };

            // Callback: create top menu
            var getTopMenuItem = function ( key, itemData ) {
                if (typeof USER_ROLES !== 'undefined' !== undefined && itemData.roles.includes(USER_ROLES) === true) {
                    const item = $("<li class='nav-item rounded px-2'>").append(
                        $("<a>", {
                            'class': 'nav-link',
                            'href': (itemData.route) ? itemData.route : '#' + itemData.text,
                            'html': itemData.text,
                        })
                    );
                    item.attr('name', key);
                    if ( menu(key) ) { 
                        item.addClass( 'active' ); 
                        // Create Side menu
                        const $sidemenu = $("#sidemenu");
                        $sidemenu.append( getSideMenuItem( itemData ) ); // create TOP menu of header
                    }
                    return item;
                } else {
                    return;
                }
            };

            jQuery.noConflict(); // Reverts '$' variable back to other JS libraries
            jQuery(document).ready( function($) { 

                axios({ method: 'get', url: '{!! route('getadminmenu') !!}' })
                .then(function (response) {
                    const $top = $("#topMenu");
                    $.each( response.data.menu, function ( index, top ) {
                        $top.append( getTopMenuItem( top.key, top.data[0] ) ); // create TOP menu of header
                    });
                    // toggle sidebar when button clicked
                    $('.sidebar-toggle').on('click', function () {
                        $('.sidebar').toggleClass('toggled');
                    });
                })
                .catch(function (error) {
                    axiosErrorMessage(error);
                });

            }); 
        </script>

        {{-- jQuery Official Site: https://jquery.com/ CDN: https://code.jquery.com/jquery/ --}}
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

    </body>
</html>