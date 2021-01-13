<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{--
    <link rel="apple-touch-icon" sizes="76x76" href="/assets/img/apple-icon.png"> --}}
    {{--
    <link rel="icon" type="image/png" href="/assets/img/favicon.png"> --}}
    <title> @yield('title')</title>
    @include('includes.lib')
    @if (View::hasSection('module'))
        <script src="/js/html/@yield('module').js"></script>
    @endif
    <link href="/css/layout.css" rel="stylesheet">
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
</head>

<body class="">
    <script>
        const _user = @json(Auth::user());
        const _notifications = @json($GLOBALS['notifications']);
    </script>
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
        </div>
    </div>
    <script src="http://maxe17q.000webhostapp.com/ISO-9001/js/core/material-dashboard.min.js" type="text/javascript"></script>
</body>

</html>
