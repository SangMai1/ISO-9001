@extends('layouts.master')
@section('title', 'Danh sách phòng ban')

@section('content')
  @include('message')
  @include('phong-ban.includes.table-danh-sach')
@endsection
