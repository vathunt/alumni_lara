<!-- HEADER MOBILE-->
<header class="header-mobile d-block d-lg-none">
    <div class="header-mobile__bar">
        <div class="container-fluid">
            <div class="header-mobile-inner">
                <a class="logo" href="home">
                    <img src="{{ asset('images/icon-sim-alumni.png') }}" alt="CoolAdmin" />
                </a>
                <button class="hamburger hamburger--slider" type="button">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
    </div>
    <nav class="navbar-mobile">
        <div class="container-fluid">
            <ul class="navbar-mobile__list list-unstyled">
                <li>
                    <a href="home"><i class="fas fa-tachometer-alt"></i>Dashboard</a>
                </li>
                <li>
                    <a href="tracer_study"><i class="far fa-check-square"></i>Tracer Study</a>
                </li>
                @if(Auth::user()->id_status == 1)
                <li>
                    <a href="alumni"><i class="fas fa-graduation-cap"></i>Alumni</a>
                </li>
                <li>
                    <a href="pengumuman"><i class="fas fa-bullhorn"></i>Pengumuman</a>
                </li>
                <li>
                    <a href="berita"><i class="far fa-newspaper"></i>Berita</a>
                </li>
                <li>
                    <a href="pengguna"><i class="far fa-user"></i>Pengguna</a>
                </li>
                @endif
                <li>
                    <a href="#" class="logout" onclick="logout()"><i class="zmdi zmdi-power"></i>Logout</a>
                </li>
            </ul>
        </div>
    </nav>
</header>
<!-- END HEADER MOBILE-->

<!-- MENU SIDEBAR-->
<aside class="menu-sidebar d-none d-lg-block">
    <div class="logo">
        <a href="home">
            <img src="{{ asset('images/icon-sim-alumni.png') }}" alt="Cool Admin" />
        </a>
    </div>
    <div class="menu-sidebar__content js-scrollbar1">
        <nav class="navbar-sidebar">
            <ul class="list-unstyled navbar__list">
                <li>
                    <a href="home">
                        <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                </li>
                @if(Auth::user()->id_status == 2)
                <li>
                    <a href="tracer_study">
                        <i class="far fa-check-square"></i>Tracer Study</a>
                </li>
                @endif
                @if(Auth::user()->id_status == 1)
                <li>
                    <a href="alumni">
                        <i class="fas fa-graduation-cap"></i>Alumni</a>
                </li>
                <li>
                    <a href="pengumuman"><i class="fas fa-bullhorn"></i>Pengumuman</a>
                </li>
                <li>
                    <a href="berita"><i class="fas fa-newspaper"></i>Berita</a>
                </li>
                <li>
                    <a href="pengguna">
                        <i class="far fa-user"></i>Pengguna</a>
                </li>
                @endif
                <li>
                    <a href="#" class="logout" onclick="logout()"><i class="fas fa-sign-out-alt"></i>Logout</a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
<!-- END MENU SIDEBAR-->