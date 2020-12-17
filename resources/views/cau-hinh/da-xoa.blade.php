@extends('layouts.master')
@section('title', 'Quản lý cấu hình')
@section('pageName', 'Danh sách cấu hình đã xóa')
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
@section('content')
    @if (Session::get('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif
    @if (Session::get('fail'))
        <div class="alert alert-danger">
            {{ Session::get('fail') }}
        </div>
    @endif
    <br>

    <div class="row">

        <div class="col-md-6">
            <div class="pull-left ">
                <a class="btn btn-success" href="{{ url('/cau-hinh/danh-sach') }}" style="margin-bottom: 10px" title="Quay lại trang danh sách "> <i
                        class="fas fa-list"></i> </a>
            </div>
            
           
        </div>
       
    </div>
    <table class="table table-bordered "><br><br>
        <thead>
            <tr>
                <th><input type="checkbox" id="chkCheckAll"></th>
                <th>Stt</th>
                <th>Mã</th>
                <th>Tên</th>
                <th>Giá trị</th>
                <th>Người tạo</th>
                <th>Người sửa</th>
                <th>Ngày xóa</th>
                <th>Khôi phục</th>
                <th>Xóa</th>
                


            </tr>
        </thead>
        <tbody>
            <?php
            $stt = 0;
            foreach ($cauhinhs as $value):
            $stt++; ?>
            <tr>
                <td><input type="checkbox" name="ids" class="checkBoxClass" value="{{ $value['id'] }}" /></td>
                <td>{{ $stt }}</td>
                <td>{{ $value['ma'] }}</td>
                <td>{{ $value['ten'] }}</td>
                <td>{{ $value['giatri'] }}</td>
                <td>{{ $value['nguoitao'] }}</td>              
                <td>{{ $value['nguoisua'] }}</td>
                <td>{{ $value['deleted_at'] }}</td>
                <td><a href="{{ route('restoreDeletedCauhinhs', $value->id) }}" title="Khôi phục">
                    <i class="fas fa-window-restore text-success  fa-lg"></i>
                </a></td>
                <td> <a href="{{ route('deletePermanently', $value->id) }}" title="Xóa hoàn toàn">
                    <i class="fas fa-trash text-danger  fa-lg"></i>
                </a></td>
                
                        

            </tr>
            <?php
            endforeach;
            ?>

        </tbody>

    </table>
    <div class="d-flex justify-content-center">{{ $cauhinhs->onEachSide(1)->links() }}</div>
    <!-- small modal -->

    

@endsection
