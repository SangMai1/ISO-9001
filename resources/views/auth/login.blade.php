@extends('layouts.auth')
@section('title') {{ __('lang.Login') }} @endsection

@section('content')
    <script>
        localStorage.removeItem('menu')
    </script>
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8 col-sm-12" style="max-width: 570px">
            <x-card color="info">
                @slot('title') {{ __('lang.Login') }} @endslot
                @slot('subTitle') Hệ thống quản lí ISO 9001 @endslot
                @slot('body')
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <x-input title="{{ __('lang.Username') }}" type="text" required autofocus :error="$errors->has('username') ? $errors->first('username') : null" name="username" float value="admin" />
                        <x-input title="{{ __('lang.Password') }}" type="password" name="password" required :error="$errors->has('password') ? $errors->first('password') : null" float value="12345678" />
                        <button type="submit" class="btn btn-info mt-3 w-100">{{ __('lang.Login') }}</button>
                        <a class="btn btn-link mt-2 w-100" href="{{ route('password.request') }}">{{ __('lang.ForgotYourPassword') }}</a>
                    </form>
                @endslot
            </x-card>
        </div>
    </div>
@endsection
