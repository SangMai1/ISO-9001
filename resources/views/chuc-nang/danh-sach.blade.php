@extends('layouts.master')
@section('title', 'Danh sách chức năng')
@section('content')
    <div id="active-menu" href="{{ route('chucnang.list') }}"></div>
    @include('chuc-nang.table-include')
@endsection
