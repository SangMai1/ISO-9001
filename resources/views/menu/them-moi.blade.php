@extends('layouts.master')
@section('title', 'Thêm mới menu')

@section('content')
    <form action="" method="POST" ajax-form>
        @csrf
        <x-input title="Vị trí" type="text" name="vitri" float />
        <x-input title="Tên menu" type="text" name="ten" float />
        <x-input title="Đường dẫn" type="text" name="url" float />
        <x-input title="Menu cha" type="text" name="idcha" float />
        <x-input title="Icon" type="textarea" name="icon" rows="4" float />
        <button class="btn btn-info">Thêm</button>
        <a href="{{route('menu.list')}}" class="btn btn-info">Danh sách</a>
    </form>
@endsection
