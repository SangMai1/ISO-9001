<nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top " id="navbar">
    <div class="container-fluid">
        <div class="navbar-wrapper">
            <a class="navbar-brand px-3">
                {{ View::hasSection('pageName') ? $__env->yieldContent('pageName') : (View::hasSection('title') ? $__env->yieldContent('title') : 'ISO-9001') }}
            </a>
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end">
            <form class="navbar-form">
                <div class="input-group no-border has-warning">
                    <input type="text" value="" class="form-control white-input" placeholder="Search...">
                    <button type="submit" class="btn btn-white btn-round btn-just-icon">
                        <i class="material-icons">search</i>
                        <div class="ripple-container"></div>
                    </button>
                </div>
            </form>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="javascript:;">
                        <i class="material-icons">dashboard</i>
                        <p class="d-lg-none d-md-block">
                            Stats
                        </p>
                    </a>
                </li>
                {{-- <li class="nav-item dropdown">
                    <a class="nav-link" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="material-icons">notifications</i>
                        <span class="notification">5</span>
                        <p class="d-lg-none d-md-block">
                            Some Actions
                        </p>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="#">Mike John responded to your email</a>
                        <a class="dropdown-item" href="#">You have 5 new tasks</a>
                        <a class="dropdown-item" href="#">You're now friend with Andrew</a>
                        <a class="dropdown-item" href="#">Another Notification</a>
                        <a class="dropdown-item" href="#">Another One</a>
                    </div>
                </li> --}}
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown">
                        <i class="material-icons">person</i>
                        <span class="screen-sm-hide">{{ Auth::user()->username }}</span>
                        <p class="d-lg-none d-md-block">
                            {{ Auth::user()->username }}
                        </p>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                        <a class="dropdown-item" href="#">Tài khoản</a>
                        <a class="dropdown-item" href="#">Cài đặt</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="javascript:$('#logoutForm')[0].submit()">Đăng xuất</a>
                        <form action="{{ route('logout') }}" id="logoutForm" method="POST"> @csrf</form>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
