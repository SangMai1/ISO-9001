@extends('layouts.master')
@section('title', 'Danh sách lịch xuất xe')

@section('content')
    <div id="active-menu" href="{{ route('lichxuatxe.list') }}"></div>
    @include('lich-xuat-xe.table-include')
@endsection