@extends('layouts.master')
@section('title', 'Quản lý nhân viên')
@section('pageName', 'Danh sách nhân viên')
@section('module','danh-sach')

@section('content')
    @if ( Session::has('success') )
        <div class="alert alert-success alert-dismissible" role="alert">
            <strong>{{ Session::get('success') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                <span class="sr-only">Đóng</span>
            </button>
        </div>
    @endif

    <?php //Hiển thị thông báo lỗi?>
    @if ( Session::has('error') )
        <div class="alert alert-danger alert-dismissible" role="alert">
            <strong>{{ Session::get('error') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                <span class="sr-only">Đóng</span>
            </button>
        </div>
    @endif
    
    <button class="btn btn-primary buttonDelete" style="float: right"><i class="fas fa-trash-alt"></i></button>
    <a href="{{route('nhanvien.add')}}" class="btn btn-primary" style="float: right"><i class="fas fa-plus-circle"></i></a>
    <button class="btn btn-primary viewFind" style="float: right"><i class="fa fa-search"></i></button>

    {{-- Search --}}
    <div class="viewForm">
        <form action="{{route('nhanvien.find')}}" method="GET">
            <button type="submit" class="btn btn-primary">Tìm kiếm</button>
        </form>
    </div>
    <form method="post" id="formDelete" action="{{ route('nhanvien.delete') }}">
        <input type="hidden" name="ids" id="ids"/>
        {{ csrf_field() }}
        <x-table auto-index select id="table">
            @slot('head')
                <th>Mã</th>
                <th>Tên</th>
            @endslot
            @slot('body')
                @foreach ($nhanviens as $item)
                    <tr data-id="{{ $item->id }}">
                        <td>{{ $item->ma }}</td>
                        <td><a  href="{{route('nhanvien.edit',["id"=>$item->id])}}">{{ $item->ten }}</a></td>
                    </tr>
                @endforeach
            @endslot
        </x-table>
    </form>

    <!-- The Modal Delete -->
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