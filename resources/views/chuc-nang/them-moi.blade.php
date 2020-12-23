@extends('layouts.master')
@section('title', 'Thêm mới Chức năng')

@section('content')
    @include('message')
    <form method="post" autocomplete="off" ajax-form>
        @csrf
        <x-input title="Tên" type="text" name="ten" float />
        <x-input title="Url" type="text" name="url" float />
        <button class="btn btn-info " type="submit">Thêm</button>
        <a class="btn btn-info" href="{{ route('chucnang.list') }}" role="button">Danh sách</a>
    </form>
    <script>
        $('form[ajax-form]').validateCustom({
            rules: {
                ten: {
                    required: true,
                    minlength: 5
                },
                url: {
                    required: true,
                    minlength: 1
                },
            }
        });

    </script>
@endsection
