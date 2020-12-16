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
            <x-input title="title" type="text" name="name" error="Lỗi nè" float/>
            <x-input title="title2" type="text" name="name" float/>
            <x-input type="text" name="name" float>
                @slot('title') <label>123</label> @endslot
            </x-input>
            <x-input title="render" type="checkbox" name="name" error="Lỗi tiếp nè"/>
        @endslot
    </x-card>
@endsection
