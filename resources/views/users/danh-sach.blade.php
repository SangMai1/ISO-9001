@extends('layouts.master')
@section('title', 'Danh sách User')
@section('module', 'users/danh-sach')

@section('content')
    @include('users.table-include');
@endsection
