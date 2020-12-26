@extends('layouts.master')
@section('title', 'Danh sách nhóm')

@section('content')
    <div id="active-menu" href="{{ route('nhom.list') }}"></div>
    @include('nhom.table-include')
@endsection
