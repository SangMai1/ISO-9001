@extends('layouts.master')
@section('title', 'Thêm mới Chức năng')
@section('module', '/chuc-nang/validation')
@section('content')
    <div id="active-menu" href="{{ route('chucnang.create') }}"></div>
    @include('message')

    <form method="post" autocomplete="off" ajax-form> 
        @csrf
        <x-input title="Tên" type="text" name="ten" float />
        <x-input title="Url" type="text" name="url" float />
        <button class="btn btn-info " type="submit">Thêm</button>
        <a class="btn btn-info" href="{{ route('chucnang.list') }}" role="button">Danh sách</a>
    </form>

@endsection
