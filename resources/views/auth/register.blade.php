@extends('layouts.auth')
@section('title') {{ __('lang.Register') }} @endsection
@section('content')
    <div class="row">
        <div class="col-md-10 col-lg-8 col-sm-12 m-auto" style="max-width: 570px">
            <x-card color="info">
                @slot('title') {{ __('lang.Register') }} @endslot
                @slot('body')
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <x-input title="{{ __('lang.Username') }}" type="text" name="username" float :error="$errors->has('username') ? $errors->first('username') : null" />
                        <x-input title="{{ __('lang.E-Mail Address') }}" type="text" name="email" float :error="$errors->has('email') ? $errors->first('email') : null" />
                        <x-input title="{{ __('lang.Password') }}" type="password" name="password" float :error="$errors->has('password') ? $errors->first('password') : null" />
                        <x-input title="{{ __('lang.Confirm Password') }}" type="password" float />
                        <button type="submit" class="btn btn-info">{{ __('lang.Register') }}</button>
                    </form>
                @endslot
            </x-card>
        </div>
    </div>
    <script>
        ${}
    </script>
@endsection
