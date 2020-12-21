@extends('layouts.master')
@section('title', 'Quản lý chức năng')
@section('pageName', 'Danh sách chức năng')
@section('module', 'chuc-nang/danh-sach')

@section('content')
    @include('chuc-nang.table-include')
@endsection
