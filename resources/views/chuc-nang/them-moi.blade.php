@extends('layouts.master')

@section('title', '')
@section('pageName', '')

@section('content')

    <div class="container">
        <!-- Alert message (start) -->
        @if (Session::has('message'))
            <div class="alert {{ Session::get('alert-class') }}">
                {{ Session::get('message') }}
            </div>
        @endif
        <!-- Alert message (end) -->

        <x-card>
            @slot('title') Thêm mới chức năng @endslot
            @slot('body')
                <form method="post" action="{{ url('/chuc-nang/them-moi') }}">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <x-input title="Tên" type="text" name="ten" float />
                        @if ($errors->has('ten'))
                            <span class="errormsg">{{ $errors->first('ten') }}</span>
                        @endif

                    </div>

                    <div class="form-group">
                        <x-input title="Url" type="text" name="url" float />
                        @if ($errors->has('url'))
                            <span class="errormsg">{{ $errors->first('url') }}</span>
                        @endif

                    </div>

                    <input class="btn btn-sm btn-primary " type="submit" value="Thêm" />
                    <a class="btn btn-sm btn-primary" href="/chuc-nang/danh-sach" role="button">Danh sách</a>

                </form>
            @endslot
        </x-card>


    </div>
@endsection
