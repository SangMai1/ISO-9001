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
            @slot('title') Cập nhật chức năng @endslot
            @slot('body')

                <form method="post" action="{{ route('chucnang.update') }}" id="myModalEdit">
                    {{ csrf_field() }}
                    <input class="form-control" type="hidden" name="id" value="{{ $chucnang['id'] }}" /><br>
                    <div class="form-group">
                        <x-input title="Tên" type="text" name="ten" value="{{ old('name', $chucnang->ten) }}" float />

                        @if ($errors->has('ten'))
                            <span class="errormsg">{{ $errors->first('ten') }}</span>
                        @endif

                    </div>

                    <div class="form-group">
                        <x-input title="URL" type="text" name="url" value="{{ old('name', $chucnang->url) }}" float />

                        @if ($errors->has('url'))
                            <span class="errormsg">{{ $errors->first('url') }}</span>
                        @endif

                    </div>

                    <input class="btn btn-sm btn-primary" type="submit" value="Cập nhật" />


                </form>

            @endslot
        </x-card>

    </div>

@endsection
