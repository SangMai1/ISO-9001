@extends('layouts.master')
@section('title', 'Cập nhật chức năng')

@section('content')
    <form method="post" action="{{ route('chucnang.update') }}" ajax-form>
        @csrf
        <input type="hidden" name="id" value="{{ $chucnang->id }}">
        <x-input title="Tên chức năng" type="text" name="ten" value="{{ $chucnang->ten }}" float />
        <x-input title="Đường dẫn" type="text" name="url" value="{{ $chucnang->url }}" float />
        <button class="btn btn-info" type="submit">Cập nhật</button>
        <a class="btn btn-info" href="{{ route('chucnang.list') }}">Danh sách</a>
    </form>
@endsection
