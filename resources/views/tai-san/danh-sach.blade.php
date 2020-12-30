@extends('layouts.master')
@section('title', 'Danh sách tài sản')

@section('content')
    <div id="active-menu" href="{{ route('taisan.list') }}"></div>
    @include('tai-san.table-include')
@endsection
