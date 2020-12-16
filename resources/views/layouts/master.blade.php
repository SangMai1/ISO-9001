<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="/assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="/assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title> @yield('title')</title>
    @include('includes.lib')
    <link href="/css/layout.css" rel="stylesheet">
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
</head>

<body class="">
    <div class="wrapper ">
        @include('includes.sidebar')
        <div class="main-panel">
            <!-- Navbar -->
            @include('includes.nav-bar')
            <!-- End Navbar -->
            <div class="content">
                <div class="container-fluid">
                    @section('content')
                    @show
                </div>
            </div>
            @include('includes.footer')
        </div>
    </div>
    <div class="fixed-plugin">
        <div class="dropdown show-dropdown">
            <a href="#" data-toggle="dropdown">
                <i class="fa fa-cog fa-2x"> </i>
            </a>
            <ul class="dropdown-menu">
                <li class="header-title"> Sidebar Filters</li>
                <li class="adjustments-line">
                    <a href="javascript:void(0)" class="switch-trigger active-color">
                        <div class="badge-colors ml-auto mr-auto">
                            <span class="badge filter badge-purple" data-color="purple"></span>
                            <span class="badge filter badge-azure" data-color="azure"></span>
                            <span class="badge filter badge-green" data-color="green"></span>
                            <span class="badge filter badge-warning" data-color="orange"></span>
                            <span class="badge filter badge-danger" data-color="danger"></span>
                            <span class="badge filter badge-rose active" data-color="rose"></span>
                        </div>
                        <div class="clearfix"></div>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="/assets/js/material-dashboard.js?v=2.1.2" type="text/javascript"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />

    <script src="/js/master-layout.js"></script>
    @if (config('app.env') == 'local')
        <script src="http://localhost:35729/livereload.js"></script>
    @endif
    <script data-main="/js/layout.js" src="/js/require.js"></script>
    @if (View::hasSection('module'))
        <script>
            requirejs(["html/@yield('module')"])

        </script>
    @endif)
</body>

</html>
