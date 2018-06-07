{{-- Floating Top Button --}}
<button id="topButton" type="button" class="btn btn-primary btn-circle btn-lg" title="Go to top" onclick="topFunction()" style="display: none;"><i class="fas fa-arrow-up"></i></button>
{{-- Navigation Bar --}}
<nav class="navbar navbar-dark bg-dark navbar-expand-lg sticky-top">
    <div style="min-width:250px; max-width:250px;">
        @auth
            <a class="sidebar-toggle text-light mr-3"><i class="fas fa-bars"></i></a>
        @endauth
        <a class="navbar-brand" href="{{ URL::to('/') }}/admin">{{ config('app.name', 'Application Name') . " Admin" }}</a>
    </div>
    {{-- Collapse 되었을 때 나타날 버튼 --}}
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="fas fa-bars"></span>
    </button>
    @auth
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul id="topMenu" class="navbar-nav mr-auto">

        </ul>

        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle " href="#" id="navbarDropdownMenuLink" data-toggle="dropdown">
                    <i class="fas fa-fw fa-user mr-1"></i>{{ Auth::user()->name }}
                </a>
                <div id="userDropdownMenu" class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-fw fa-sign-out-alt fa-lg mr-1"></i>{{ trans('messages.button.logout') }}
                    </a>
                    <a href="/" class="dropdown-item"><i class="fas fa-fw fa-home fa-lg mr-1"></i>@lang('messages.button.home')</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
                </div>
            </li>
        </ul>
    </div>
    @endauth 
</nav>
