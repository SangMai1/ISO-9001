@extends('layouts.master')
@section('title', 'Danh sách nhóm')
@section('module', 'nhom/danh-sach')

@section('content')
    @include('nhom.table-include');
@endsection
