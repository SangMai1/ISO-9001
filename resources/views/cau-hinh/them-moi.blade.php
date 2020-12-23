@extends('layouts.master')
@section('title', 'Thêm mới Cấu hình')

@section('content')
    @include('message')
    <form method="post" autocomplete="off" ajax-form>
        @csrf
        <x-input title="Mã" type="text" name="ma" float />
        <x-input title="Tên" type="text" name="ten" float />
        <x-input title="Giá trị" type="text" name="giatri" float />
        <button class="btn btn-info " type="submit">Thêm</button>
        <a class="btn btn-info" href="{{ route('cauhinh.list') }}" role="button">Danh sách</a>
    </form>
    <script>
        $('form[ajax-form]').validateCustom({
            rules: {
                ma: {
                    required: true,
                    minlength: 5
                },
                ten: {
                    required: true,
                    minlength: 6
                },
                giatri: {
                    required: true,
                    minlength: 3
                },
            }
        });

    </script>
@endsection
