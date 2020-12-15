@extends('layouts.master')
@section('title', 'Test')
@section('module', 'example')

@section('content')
    {{-- active menu --}}
    <div id="active-menu" href="/quan-li-xe/lich-sua-xe" active="khoiPhucTaiKhoan"></div>

    {{-- card component --}}
    <x-card>
        @slot('title') <em>Title</em> @endslot
        @slot('subTitle') category @endslot
        @slot('body')
            <x-input title="title" type="text" name="name" float/>
        @endslot
    </x-card>
@endsection
