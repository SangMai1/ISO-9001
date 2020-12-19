@extends('layouts.master')
@section('title', 'Quản lý nhóm')
@section('pageName', 'Danh sách nhóm')
@section('module', 'nhom/danh-sach')

@section('content')
    <div class="d-none csrf_token">@csrf</div>
    <x-card>
        @slot('title') Danh sách nhóm @endslot
        @slot('body')

            {{-- Thêm mới nhóm --}}
            <a href="/nhom/them-moi" class="btn btn-sm btn-primary"><i class="fas fa-plus-circle"></i></a>

            {{-- Xóa nhóm --}}
            <button class="btn btn-sm btn-primary" id="delete-btn"><i class="fas fa-trash-alt"></i></button>

            {{-- Search --}}
            <form action="{{ route('nhom.search') }}" method="GET">
                <div class="form-group">
                    <x-input title="Tìm kiếm" type="text" name="search" float />
                    <button type="submit" class="btn btn-sm btn-primary">Tìm kiếm</button>

                </div>
            </form>
            <x-table auto-index select id="main-list">
                @slot('head')
                    <th>Mã</th>
                    <th>Tên</th>
                @endslot
                @slot('body')
                    @foreach ($nhoms as $ns)
                        <tr data-id="{{ $ns->id }}">
                            <td>
                                {{ $ns->ma }}
                            </td>
                            <td> <a href="{{ route('nhom.edit', [$ns->id]) }}">
                                    {{ $ns->ten }}</a>
                            </td>
                        </tr>
                    @endforeach
                @endslot
            </x-table>
        @endslot
    </x-card>
    
    <div class="modal" tabindex="-1" role="dialog" id="myDelete">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="delete-body">
                    <h4>Bạn có muốn xóa không?</h4>


                </div>
                <div class="modal-footer">
                    <button type="button" id="delRef" class="btn btn-primary">Xác nhận</button>
                    <button type="button" class="btn btn-primary thoat" data-dismiss="modal">Thoát</button>
                </div>
            </div>
        </div>
    </div>
@endsection
