@extends('layouts.master')
@section('title', 'Danh sách xe')

@section('content')
    <div id="active-menu" href="{{ route('xe.list') }}"></div>
    @include('xe.table-include')
@endsection