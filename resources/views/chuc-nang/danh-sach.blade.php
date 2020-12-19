@extends('layouts.master')
<<<<<<< HEAD
@section('title', 'Quản lý chức năng')
@section('pageName', 'Danh sách chức năng')
@section('module', 'chuc-nang/danh-sach')

@section('content')
    {{-- <div class="container">
        <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#myModal" id="bnn"><i
                class="fas fa-plus-circle"></i></button>
        <button class="btn btn-primary buttonDelete"><i class="fas fa-trash-alt"></i></button>

        {{-- Search --}}
        {{-- <form action="{{ route('searchChucNang') }}" method="GET">
            <div class="input-group">
                <input type="text" name="search" class="form-group" />
                <span class="input-group-prepend">
                    <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                </span>
            </div>
        </form> --}}

        <!-- The Modal Add New-->
        {{-- <div class="modal" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4>Thêm mới chức năng</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div id="model-body"></div>
                    <div class="modal-footer">

                    </div>
                </div>
            </div>
        </div> --}}

        <!-- The Modal Edit -->
        {{-- <div class="modal" id="myEdit">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4>Edit chức năng</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div id="edit-body">
                        <form method="post" action="{{ route('editChucNang') }}">
                            {{ csrf_field() }}
                            <input class="form-control" type="hidden" name="id" id="id_edit" /><br>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ten">Tên <span
                                        class="required"></span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="ten_edit" class="form-control col-md-12 col-xs-12" name="ten"
                                        placeholder="Enter subject ten" required="required" type="text">

                                    @if ($errors->has('ten'))
                                        <span class="errormsg">{{ $errors->first('ten') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Url <span
                                        class="required"></span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="url_edit" class="form-control col-md-12 col-xs-12" name="url"
                                        placeholder="Enter subject url" required="required" type="text">

                                    @if ($errors->has('url'))
                                        <span class="errormsg">{{ $errors->first('url') }}</span>
                                    @endif
                                </div>
                            </div>

                            <input class="btn btn-primary" type="submit" value="Cập nhật" />

                    </div>
                    </form>
                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div> --}}

    <!-- The Modal Delete -->
    {{-- <div class="modal" tabindex="-1" role="dialog" id="myDelete">
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
    </div> --}}

    <!-- Alert message (start) -->
    {{-- @if (Session::has('message'))
        <div class="alert {{ Session::get('alert-class') }}">
            {{ Session::get('message') }}
        </div>
    @endif --}}
    <!-- Alert message (end) -->

    @include('chuc-nang.table-include')

    {{-- <form method="post" id="formDelete" action="{{ route('xoaChucNang') }}">
        {{ csrf_field() }}
        <table class="table table-bordered table-hover">
            <tr>
                <th width="50px"><input class="sub_chk" type="checkbox" id="master"></th>
                <th>STT</th>
                <th>Tên</th>
                <th>URL</th>
            </tr>
            @foreach ($chucNangs as $cn)
                <tr>
                    <td><input type="checkbox" value={{ $cn->id }} name="idss[]"></td>
                    <td>
                        {{ $cn->id }}
                    </td>
                    <td class="edit" href="{{ route('edit', [$cn->id]) }}" data-toggle="modal" data-target="#myEdit">
                        {{ $cn->ten }}
                    </td>
                    <td>
                        {{ $cn->url }}
                    </td>

                </tr>
            @endforeach
        </table>
    </form> --}}

    {{-- </div> --}}
=======
@section('title', '')
@section('pageName', '')

@section('content')
    <div class="container">


        <!-- Alert message (start) -->
        @if (Session::has('message'))
            <div class="alert {{ Session::get('alert-class') }}">
                {{ Session::get('message') }}
            </div>
        @endif
        <!-- Alert message (end) -->
        <x-card>
            @slot('title') Danh sách chức năng @endslot
            @slot('body')
>>>>>>> 32af8890aafc1b41c0d2a76e8351281ef504551b

                {{-- Thêm mới chức năng --}}
                <a href="/chuc-nang/them-moi" class="btn btn-sm btn-primary"><i class="fas fa-plus-circle"></i></a>

<<<<<<< HEAD
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        var link_url = "/chuc-nang/them-moi #myModal";
        $('#model-body').html(event).load(link_url);

        $('#bnn').on('click', function(event) {
            event.preventDefault();
            $('#myModal').modal('hide');

        });


        $('.edit').on('click', function(event) {
            event.preventDefault();
            var href = $(this).attr('href');
            $.ajax({
                url: href,
                type: 'get',
                dataType: 'json',
                success: function(cn) {
                    console.log('sang', cn);
                    $('#id_edit').val(cn.id);
                    $('#ten_edit').val(cn.ten);
                    $('#url_edit').val(cn.url);

                }
            });

        });
=======
                {{-- Xóa chức năng --}}
                <button class="btn btn-sm btn-primary buttonDelete"><i class="fas fa-trash-alt"></i></button>

                {{-- Search chức năng --}}
                <form action="{{ route('chucnang.search') }}" method="GET">
                    <div class="form-group">

                        <x-input title="Tìm kiếm" type="text" name="search" float />
                        <button type="submit" class="btn btn-sm btn-primary">Tìm kiếm</button>

                    </div>
                </form>
                <x-table auto-index select>
                    @slot('head')
                        <th>Tên</th>
                        <th>URL</th>
                    @endslot
                    @slot('body')
                        @foreach ($chucNangs as $cn)
                            <tr data-id="{{ $cn->id }}" name="idss[]">
                                <td><a href="{{ route('chucnang.edit', [$cn->id]) }}">{{ $cn->ten }}</a></td>
                                <td>{{ $cn->url }}</td>
                            </tr>
                        @endforeach
                    @endslot
                </x-table>
            @endslot
        </x-card>






        <!-- The Modal Delete -->
        <div class="modal" tabindex="-1" role="dialog" id="myDelete">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
>>>>>>> 32af8890aafc1b41c0d2a76e8351281ef504551b

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





    </div>


@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.buttonDelete').on('click', function(event) {
            event.preventDefault();
            $('#myDelete').modal();
            $('#delRef').click(function() {
                $('#formDelete').submit();
            });

        });

    });

</script>
