@extends('layouts.master')
@section('title', '')

@section('content')
    <div>{{$menu ?? 'no menu'}}</div>
    <a class="btn btn-sm btn-info mb-3" href="{{ route('menu.create') }}"><i class="fas fa-plus-circle"></i></a>
    @include('menu.danh-sach-table-include')
@endsection
