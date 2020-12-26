@extends('layouts.master')

@section('title', 'Quản lý danh mục')
@section('pageName', 'Thêm mới danh mục')

@section('content')
  <div id="active-menu" href="{{ route('danhmuc.create') }}"></div>
  @include('message')
  <form method="post" autocomplete="off" ajax-form>
    {{csrf_field()}}

    <x-input title="Tên" type="text" name="ten" id="ten" float/>
    <x-input title="Mã" type="text" name="ma" float/>
    <x-input title="" type="hidden" name="loai" value="{{$loaiDm}}" float/>

    <input class="btn btn-sm btn-info" type="submit" value="Lưu" />
          <a class="btn btn-sm btn-info" href="{{route('danhmuc.list')}}?loai={{$loaiDm}}" role="button">Danh sách</a>
  </form>
@endsection