@extends('layouts.master')
@section('title', 'Cập nhật danh mục')

@section('content')
  <form method="post" action="{{ route('danhmuc.update') }}" ajax-form>
    @csrf
    <input type="hidden" name="id" value="{{ $danhmuc->id }}">
    <x-input title="Mã danh mục" type="text" name="ma" value="{{ $danhmuc->ma }}" float />
    <x-input title="Tên danh mục" type="text" name="ten" value="{{ $danhmuc->ten }}" float />
    <x-input title="" type="hidden" name="loai" value="{{$danhmuc->loai}}" float/>
    
    <button class="btn btn-sm btn-info" type="submit">Lưu</button>
    <a class="btn btn-sm btn-info" href="{{ route('danhmuc.list') }}?loai={{$danhmuc->loai}}">Danh sách</a>
  </form>

@endsection