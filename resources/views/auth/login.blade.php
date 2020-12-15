<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="/assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="/assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title> Đăng nhập</title>
    @include('includes.lib')
    <link href="/css/layout.css" rel="stylesheet">
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
</head>

<body class="">
    <div class="wrapper ">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 mt-4">
                    <x-card>
                        @slot('title') {{ __('lang.Login') }} @endslot
                        @slot('subTitle') Hệ thống quản lí ISO 9001 @endslot
                        @slot('body')
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-8 offset-md-2">
                                        <x-inputs.input title="{{ __('lang.Email') }}" type="email"
                                            :error="$errors->has('email') ? $error->first('email') : null"
                                            :class="$errors->has('email') ? 'is-invalid' : ''" name="email"
                                            value="{{ old('email') }}" required autocomplete="email" autofocus>
                                        </x-inputs.input>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-8 offset-md-2">
                                        <x-inputs.input type="password" title="{{ __('lang.Password') }}"
                                            :error="$errors->has('password') ? $error->first('password') : null"
                                            :class="$errors->has('password') ? 'is-invalid' : ''" name="password" required
                                            autocomplete="current-password">
                                        </x-inputs.input>

                                    </div>
                                </div>
                                <div class="form-group row"> 
                                    <div class="col-md-6 offset-md-4">
                                        <x-inputs.checkbox name="remember" id="remember"
                                            :checked="old('remember') ? 'true' : ''">
                                            @slot('content') <em>{{ __('lang.RememberMe') }}</em> @endslot 
                                        </x-inputs.checkbox>
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-8 offset-md-3">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('lang.Login') }}
                                        </button>

                                        @if (Route::has('password.request'))
                                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                                {{ __('lang.ForgotYourPassword') }}
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </form>
                        @endslot
                    </x-card>
                </div>
            </div>
        </div>
    </div>
    <script src="/assets/js/material-dashboard.js?v=2.1.2" type="text/javascript"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
        integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA=="
        crossorigin="anonymous" />
    {{-- <script data-main="js/layout.js" src="/js/require.js"></script> --}}
</body>

</html>
