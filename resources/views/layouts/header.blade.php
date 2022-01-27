<header class="main-header">
    <a href="" class="logo">
        <span class="logo-mini">
            
        </span>
        <span class="logo-lg">
            
        </span>
    </a>

    <nav class="navbar navbar-static-top">
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <i class="fas fa-bars"></i>
            <span class="sr-only">Toggle navigation</span>
        </a>
        <div class="navbar-title">
        </div>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="{{ asset('dashboard-package/img/user/'.Auth::user()->foto.'') }}" class="user-image" alt="User Image">
                        <span class="hidden-xs">{{ Auth::user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="user-header">
                            <img src="{{ asset('dashboard-package/img/user/'.Auth::user()->foto.'') }}" class="img-circle" alt="User Image">
                            <p>
                                {{ Auth::user()->name }}<br>
                                <small>{{ str_replace('"', '', Auth::user()->getRoleNames())  }}</small>
                            </p>
                        </li>
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="{{ GeneralHelp::get_profil_url_level_akses() }}" class="btn btn-primary btn-flat">Profil</a>
                            </div>
                            <div class="pull-right">
                                <a href="#" class="btn btn-danger btn-flat"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Keluar
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>