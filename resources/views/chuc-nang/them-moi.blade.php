@extends('layouts.master')
@section('title', 'Thêm mới Chức năng')

@section('content')
    @include('message')
    {{-- Thuộc tính data-form để dễ tìm lại form sau khi load xong, nếu không sẽ tìm qua "action" attribute--}}
    <form method="post" data-form="addcn" ajax-form autocomplete="off">
        @csrf
        <x-input title="Tên" type="text" name="ten" float />
        <x-input title="Url" type="text" name="url" float />
        <button class="btn btn-info " type="submit">Thêm</button>
        <a class="btn btn-info" href="{{ route('chucnang.list') }}" role="button">Danh sách</a>
    </form>
    <script>
        $('form[data-form]').validateCustom({
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
