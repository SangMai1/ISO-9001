@extends('layouts.master')
@section('title', 'Quản lý nhóm')
@section('pageName', 'Danh sách nhóm')
@section('module', 'nhom/danh-sach')

@section('content')
    <x-card>

        <!-- Alert message (start) -->
        @if (Session::has('message'))
            <div class="alert {{ Session::get('alert-class') }}">
                {{ Session::get('message') }}
            </div>
        @endif
        <!-- Alert message (end) -->

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
    {{-- <button type="submit" class="btn btn-primary" data-toggle="modal"
        data-target="#myModal" id="bnn"><i class="fas fa-plus-circle"></i></button>
    <button class="btn btn-primary buttonDelete"><i class="fas fa-trash-alt"></i></button> --}}



    <!-- The Modal Add New-->
    {{-- <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">

                Modal Header
                <div class="modal-header">
                    <h4>Thêm mới chức năng</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div id="model-body">

                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div> --}}

    <!-- The Modal Edit -->
    {{-- <div class="modal" id="myEdit">
        <div class="modal-dialog">
            <div class="modal-content">

                Modal Header
                <div class="modal-header">
                    <h4>Edit nhóm</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div id="edit-body">
                    <form method="post" action="{{ route('editNhom') }}">
                        {{ csrf_field() }}
                        <input class="form-control" type="hidden" name="id" id="id_edit" /><br>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ma">Mã <span
                                    class="required"></span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="ma_edit" class="form-control col-md-12 col-xs-12" name="ma"
                                    placeholder="Enter ma" required="required" type="text">

                                @if ($errors->has('ma'))
                                    <span class="errormsg">{{ $errors->first('ma') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ten">Tên <span
                                    class="required"></span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="ten_edit" class="form-control col-md-12 col-xs-12" name="ten"
                                    placeholder="Enter ten" required="required" type="text">

                                @if ($errors->has('ten'))
                                    <span class="errormsg">{{ $errors->first('ten') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ten">Chức năng <span
                                    class="required"></span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Select</th>
                                            <th>Tên chức năng</th>
                                        </tr>
                                    </thead>
                                    <tbody class="view-per">
                                        @foreach ($idChucNang as $key => $value)
                                            <tr>
                                                <td><input type="checkbox" value={{ $key }} name="chucnangids[]"
                                                        class="chucnangids" /></td>
                                                <td>{{ $value }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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




    {{-- <form method="post" id="formDelete" action="{{ route('xoaNhom') }}">
        {{ csrf_field() }}
        <input type="hidden" id="ids" name="ids" >
        <table class="table table-bordered table-hover">
            <tr>
                <th width="50px"><input class="sub_chk" type="checkbox" id="master"></th>
                <th>STT</th>
                <th>Mã</th>
                <th>Tên</th>
            </tr>
            @foreach ($nhoms as $ns)
                <tr>
                    <td><input type="checkbox" value={{ $ns->id }} name="idss[]"></td>
                    <td>
                        {{ $ns->id }}
                    </td>
                    <td>
                        {{ $ns->ma }}
                    </td>
                    <td class="edit" href="{{ route('editnhom', [$ns->id]) }}" data-toggle="modal" data-target="#myEdit">
                        {{ $ns->ten }}
                    </td>

                </tr>
            @endforeach
        </table>
    </form> --}}
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {


        // $('.edit').on('click', function(event) {
        //     event.preventDefault();
        //     $('input[name="chucnangids[]"]').prop("checked", false);
        //     var href = $(this).attr('href');
        //     $.ajax({
        //         url: href,
        //         type: 'get',
        //         dataType: 'json',
        //         success: function(n) {
        //             console.log('sang', n);
        //             for (var key in n) {
        //                 $('#id_edit').val(n[key].id);
        //                 $('#ma_edit').val(n[key].ma);
        //                 $('#ten_edit').val(n[key].tennhom);
        //                 let cns = n[key].idchucnang;
        //                 let arr = [];

        //                 $('input[name="chucnangids[]"]').each(function() {
        //                     if (($('input[name="chucnangids[]"]').val() == cns)) {
        //                         arr.push($(this).val);
        //                     }
        //                     return arr;
        //                 });
        //                 console.log(arr);
        //                 // alert($('input[name="chucnangids[]"]').val().length);
        //                 //   console.log(cns);
        //                 // if(cns){
        //                 //   $("#chucnangids").val(cns);
        //                 // }
        //                 if ($('input[name="chucnangids[]"]').val() == cns) {
        //                     $('input[name="chucnangids[]"]').prop("checked", true);
        //                 }
        //             }
        //         }
        //     });

        // });

        $('.buttonDelete').on('click', function(event) {
            event.preventDefault();
            $('#myDelete').modal();
            $('#delRef').click(function() {
                $('#formDelete').submit();
            });
        });
    });

</script>
