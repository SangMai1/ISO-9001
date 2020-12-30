@extends('layouts.master')
@section('title', 'Danh sách lịch sử sửa chữa')

@section('content')
    <div id="active-menu" href="{{ route('lichsusuachua.list') }}"></div>
    @include('lich-su-sua-chua.table-include')
@endsection