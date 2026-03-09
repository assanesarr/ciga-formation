<header class="header_area navbar_fixed">
    <div class="main_menu">
        <div class="search_input d-none d-md-block" id="search_input_box">
            <div class="container">
                <div class="d-flex justify-content-between">
                    <div class="contact d-flex justify-content-between">
                        <div class="mr-3"><i class="ti-mobile mr-1"></i> <span>+221 338778361 / 776677470</span></div>
                        <div><i class="ti-email mr-1"></i> <a href="mailto:infociga@gmail.com" style="color: #fff;">infociga@gmail.com</a></div>
                    </div>
                    <div class="login-register ">
                        <a href="/login" class="header-login cursor-pointer">Login</a> | <a href="/register" class="header-register cursor-pointer">Register</a>
                    </div>
                </div>
            </div>
        </div>
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container">
                <a class="navbar-brand logo_h" href="#" ><img src="/images/logo.png" alt=""/></a>
                <button class="navbar-toggler" type="button" id="navbar-toggler">
                    <span class="icon-bar"></span> <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div
                    class="collapse navbar-collapse offset"
                    id="navbarSupportedContent"
                >
                    <ul class="nav navbar-nav menu_nav ml-auto">
                        @foreach($menus as $menu)
                            @if(count($menu->children) == 0)
                                <li class="nav-item @if(request()->path() == $menu->slug) active @endif">
                                    <a class="nav-link" href="{{ route('page', $menu->slug) }}" >{{ $menu->name }}</a>
                                </li>
                                @else
                                <li class="nav-item submenu dropdown">
                                    <a  class="nav-link dropdown-toggle"
                                        href="#"
                                        data-toggle="dropdown"
                                        role="button"
                                        aria-haspopup="true"
                                        aria-expanded="false"
                                    >{{ $menu->name }}</a>
                                    <ul class="dropdown-menu">
                                        @foreach($menu->children as $menu)
                                            <li class="nav-item @if(request()->path() == $menu->slug) active @endif">
                                                <a class="nav-link" href="{{ route('page', $menu->slug) }}">{{ $menu->name }}</a>
                                            </li>
                                         @endforeach
                                    </ul>
                                </li>
                            @endif

                        @endforeach
                    </ul>
                </div>

            </div>
        </nav>
    </div>
</header>
<div id="sidebar-mobile">
    <ul class="sidebar-nav d-flex flex-column justify-content-center align-items-center">
        <li class="sidebar-brand"></li>
        @foreach($menus as $menu)
            @if(count($menu->children) == 0)
                <li class="nav-item ">
                    <a class="nav-link" href="{{ route('page', $menu->slug) }}" >{{ $menu->name }}</a>
                </li>
            @else
                @foreach($menu->children as $menu)
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('page', $menu->slug) }}">{{ $menu->name }}</a>
                    </li>
                @endforeach
            @endif
        @endforeach
    </ul>
</div>
