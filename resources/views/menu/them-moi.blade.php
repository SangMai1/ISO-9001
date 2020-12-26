@extends('layouts.master')
@section('title', 'Thêm mới menu')
@section('module', 'menu/form')
@section('content')
    <style>
        ul.icc .form-check-label {
            width: 100%;
            /* max-width: 400px; */
        }

    </style>
    <form action="" method="POST" ajax-form>
        @csrf
        <x-input title="Vị trí" type="text" name="vitri" float />
        <x-input title="Tên menu" type="text" name="ten" float />
        <x-input title="Đường dẫn" type="text" name="url" float />
        <x-input title="Icon" type="textarea" name="icon" rows="4" float />
        <a data-toggle="collapse" class="dropdown-toggle btn-info btn auto-icon" style="max-width: 200px">
            <span class="cell" index="2">Chọn menu cha</span>
        </a>
        <ul class="collapse list-unstyled w-100 icc p-2" data-id="menu-parent-ul">
            <li>
                <x-input type="radio" name="idcha" float value="" checked>
                    @slot('title')
                        <div class="btn btn-danger btn-sm m-0 w-100 text-left" type="button">
                            <div class="font-weight-bold">Không</div>
                        </div>
                    @endslot
                </x-input>
            </li>
            @foreach ($menus as $m)
                <li data-parent="{{ $m->idcha }}" data-id="{{ $m->id }}">
                    <x-input type="radio" name="idcha" float value="{{ $m->id }}">
                        @slot('title')
                            <a class="btn btn-info btn-sm m-0 w-100 text-left" type="button" data-toggle="collapse" href="#">
                                <div>
                                    <div class="font-weight-bold">{{ $m->ten }}</div>
                                    <div>Đường dẫn: {{ $m->url }}</div>
                                </div>
                            </a>
                        @endslot
                    </x-input>
                </li>
            @endforeach
        </ul>

        <button class="btn btn-info">Thêm</button>
        <a href="{{ route('menu.list') }}" class="btn btn-info">Danh sách</a>
    </form>
@endsection
