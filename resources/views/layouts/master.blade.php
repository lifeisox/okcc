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

        {{-- Font Awesome 5.1.0 --}}
        <link href="{{ asset('css/fontawesome/css/all.css') }}" rel="stylesheet" type="text/css">
        {{-- Korean Fonts : <TODO>나중에 사용해보고 적절한 폰트 2-3가지만 고를 예정임</TODO> --}}
        <link href="https://fonts.googleapis.com/css?family=Gaegu:300,400,700|Gamja+Flower|Nanum+Gothic:400,800|Nanum+Myeongjo:400,800|Roboto:400,500,700,900|Montserrat:400,700|Droid+Serif:400,700,400italic,700italic" rel="stylesheet" type='text/css'>
        <link href='https://cdn.rawgit.com/young-ha/webfont-archive/master/css/Youth.css' rel='stylesheet' type='text/css'>
        {{-- toastr is a Javascript library for non-blocking notifications. jQuery is required. https://github.com/CodeSeven/toastr --}}
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
        {{-- Basic Styles --}}
        <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('css/okcc.css') }}" rel="stylesheet" type="text/css">
        {{-- for additional styles --}}
        @yield('styles')
    </head>
    <body id="top">

        @include('layouts.header')
        @yield('content')
        @include('layouts.footer')
        @include('auth.login')
        @include('auth.register')
        @include('auth.passwords.email')

        {{-- jQuery Official Site: https://jquery.com/ CDN: https://code.jquery.com/jquery/ --}}
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
        {{-- jQuery UI is a curated set of user interface interactions, effects, widgets, and themes built on top of the jQuery JavaScript Library. Official Site: https://jqueryui.com/ CDN: https://code.jquery.com/ui/ --}}
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="  crossorigin="anonymous"></script>
        {{-- jQuery Easing: A jQuery plugin from GSGD to give advanced easing options http://gsgd.co.uk/sandbox/jquery/easing/ --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
        {{-- toastr is a Javascript library for non-blocking notifications. jQuery is required. https://github.com/CodeSeven/toastr --}}
        <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        {{-- CSRF Token --}}
        <script>window.Laravel = { csrfToken: "{{ csrf_token() }}" }</script>
        {{-- Localization for JavaScript and Vue --}}
        <script src="/js/lang.js"></script>
        {{-- Custom JS --}}
        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{ asset('js/messages.js') }}"></script>
        <script src="{{ asset('js/okcc.js') }}"></script>
        {{-- jQuery idle timer --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-idletimer/1.0.0/idle-timer.min.js"></script>
        
        <script>
            // relocate home if session timeout
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
            jQuery.noConflict(); // Reverts '$' variable back to other JS libraries
            jQuery(document).ready( function($) { 

                axios({ method: 'GET', url: '{!! route('getmenu') !!}' })
                .then(function (response) {
                    const $top = $("#topMenuArea");
                    $.each( response.data.menu, function ( index, data ) {
                        $top.append( getTopMenuItem( data ) ); // create TOP menu of header
                    });
                    $top.append( $("<span>", { 'class': 'mr-5' }) );
                    var html;
                    @guest 
                        html = `<li class="nav-item nav-link"><a class="btn btn-outline-light" href="javascript:void(0)" role="button" data-toggle="modal" data-target="#loginModal">{{ trans('messages.menu.signin') }}</a></li>`;
                    @else
                        html = `<li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle " href="javascript:void(0)" id="navbarDropdownMenuLink" data-toggle="dropdown">
                                <i class="fas fa-fw fa-user mr-1"></i>{{ Auth::user()->name }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt fa-fw fa-lg mr-2"></i>{{ trans('messages.button.logout') }}
                                </a>`;
                        if (typeof USER_ROLES !== 'undefined' !== undefined && (USER_ROLES === '0' || USER_ROLES === '1')) {
                            html += `<a href="/admin" class="dropdown-item"><i class="fas fa-key fa-fw fa-lg mr-2"></i>{{ trans('messages.button.admin') }}</a>`;
                        }
                        html += `<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
                            </div>
                        </li>`;
                    @endguest
                    $top.append( html );

                    // Closes responsive menu when a scroll trigger link is clicked
                    $('#mainNav .js-scroll-trigger').click(function() {
                        $('#navbarResponsive').collapse('hide');
                    });

                    // Closes responsive menu when a hamburg icon is clicked
                    $('#mainNav .navbar-toggler').click(function() {
                        $('#navbarResponsive').toggleClass('collapse');
                    });

                    // Smooth scrolling using jQuery easing
                    // Select all links with hashes | Remove links that don't actually link to anything
                    $('a[href*="#"]').not('[href="#"]').click(function(event) {
                        // On-page links
                        if ( location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname ) {
                            // Figure out element to scroll to
                            var target = $(this.hash);
                            target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                            // Does a scroll target exist?
                            if (target.length) {
                                // Only prevent default if animation is actually gonna happen
                                event.preventDefault();
                                $('html, body').animate({ scrollTop: target.offset().top }, 1000, function() {
                                    // Callback after animation | Must change focus!
                                    var $target = $(target);
                                    $target.focus();
                                    if ($target.is(":focus")) { // Checking if the target was focused
                                        return false;
                                    } else {
                                        $target.attr('tabindex','-1'); // Adding tabindex for elements not focusable
                                        $target.focus(); // Set focus again
                                    };
                                });
                            }
                        }
                    });
                })
                .catch(function (error) {
                    axiosErrorMessage(error);
                });

            }); 

            // Create Top Menu
            const getTopMenuItem = function ( data ) {
                if (typeof USER_ROLES !== 'undefined' !== undefined && (data.roles[0] === 'ALL' || data.roles.includes(USER_ROLES) === true)) {
                    const item = $("<li class='nav-item dropdown'>").append(
                        $("<a>", {
                            'id': 'navbarDropdownMenuLink',
                            'class': 'nav-link dropdown-toggle',
                            'data-toggle': 'dropdown',
                            'aria-haspopup': 'true',
                            'aria-expanded': 'false',
                            'href': data.route ? data.route + data.anchor : data.anchor,
                            'html': data.title,
                        })
                    );
                    if ( data.submenus ) {
                        item.append(
                            $("<div>", {
                                'class': 'dropdown-menu',
                                'aria-labelledby': 'navbarDropdownMenuLink'
                            })
                        );
                        $.each( data.submenus, function ( index, list ) {
                            // TODO: 아래와 같은 형식을 참조하여 Role을 규정한다
                            // if(!USER_ROLES.includes(itemData.roles)) {
                            //     item.hide();
                            // }
                            if (typeof USER_ROLES !== 'undefined' !== undefined && (list.roles[0] === 'ALL' || list.roles.includes(USER_ROLES) === true)) {
                                item.find('div').append(
                                    $("<a>", {
                                        'class': 'dropdown-item js-scroll-trigger',
                                        'href': list.route ? list.route + list.anchor : list.anchor,
                                        'html': list.title
                                    })
                                );
                            }
                        });
                    }
                    return item;
                }
            };

        </script>
        
        @yield('scripts')

    </body>
</html>
