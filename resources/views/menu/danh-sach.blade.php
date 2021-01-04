@extends('layouts.master')
@section('title', 'Menu')
@section('module', 'menu/list')
@section('content')
    <link rel="stylesheet" href="/css/menu.css">
    <script>
        if (!window.urls) window.urls = {}
        urls.addMenuFormURL = `{{ route('menu.create') }}`
        urls.updateMenuFormURL = `{{ route('menu.edit') }}`
        urls.deleteMenuURL = `{{ route('menu.delete') }}`
        urls.listMenuURL = `{{ route('menu.list') }}`

    </script>
    @include('message')
    <div id="form-region" class="row" style="display: none">
        <button class="btn btn-primary go-back-btn"><i class="fas fa-chevron-left"></i></button>
        <div class="content">

        </div>
    </div>

    <div id="update-position-region">
        <form action="{{ route('menu.update.pos') }}" method="POST" ajax-form="updatePosAction">
            <div class="move-mode-show">
                <button type="submit" class="btn btn-sm btn-primary mr-auto update-btn">Cập nhật</button>
                <button type="button" class="btn btn-sm btn-danger mr-auto cancel-btn">Hủy</button>
            </div>
            <input name="id" type="hidden">
            <div class="move-mode-show">
                <x-input title="Vị trí" type="number" name="vitri" float checked />
            </div>
            <ul class="list-unstyled w-100 icc p-2 d-none" data-id="menu-parent-ul">
                <li class="menu-item root">
                    <div class="parent-control">
                        <div class="move-mode-show">
                            <x-input type="radio" name="idcha" float value="" />
                        </div>
                        <div class="tab-item">
                            <a class="btn btn-danger btn-sm" style="font-weight: 700">Cây gốc</a>
                            <div class="dropdown">
                                <div class="btn btn-icon btn-link" data-toggle="dropdown"><i class="fas fa-ellipsis-v"></i></div>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <div class="dropdown-item add-menu-btn"><i class="fas fa-plus-circle"></i> Thêm Menu</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                @foreach ($menus as $m)
                    <li data-parent="{{ $m->idcha }}" data-id="{{ $m->id }}" position="{{ $m->vitri }}" class="menu-item">
                        <div class="parent-control">
                            <div class="move-mode-show">
                                <x-input type="radio" name="idcha" float value="{{ $m->id }}" />
                            </div>
                            <div class="tab-item">
                                <a class="btn btn-primary btn-sm" type="button" data-toggle="collapse" href="#">
                                    <div>
                                        <div class="font-weight-bold d-flex">{{ $m->ten }}<span class="ml-auto">({{ $m->vitri }})</span></div>
                                        <div>Đường dẫn: {{ $m->url }}</div>
                                    </div>
                                </a>
                                <div class="dropdown">
                                    <div class="btn btn-icon btn-link" data-toggle="dropdown"><i class="fas fa-ellipsis-v"></i></div>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <div class="dropdown-item add-menu-btn"><i class="fas fa-plus-circle"></i> Thêm Menu</div>
                                        <div class="dropdown-item edit-menu-btn"><i class="fas fa-pencil-alt"></i>Chỉnh sửa</div>
                                        <div class="dropdown-item move-menu-btn"><i class="fas fa-pencil-alt"></i>Chuyển vị trí</div>
                                        <div class="dropdown-item delete-menu-btn"><i class="fas fa-trash"></i>Xóa</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </form>
    </div>


@endsection
