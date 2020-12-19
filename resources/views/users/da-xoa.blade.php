@extends('layouts.master')
@section('title', 'Quản lý Users')
@section('pageName', 'Danh sách users đã xóa')
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
                <a class="btn btn-success" href="{{ route('user.list') }}" style="margin-bottom: 10px" title="Quay lại trang danh sách "> <i
                        class="fas fa-list"></i> </a>
            </div>
            
           
        </div>
       
    </div>
    <table class="table table-bordered "><br><br>
        <thead>
            <tr>
                <th>Stt</th>
                <th>Name</th>
                <th>Password</th>
                <th>Nhân viên</th>
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
            foreach ($users as $value):
            $stt++; ?>
             @php
             $nhanviens = ["0"=>"Nhân viên 1","1"=>"Nhân viên 2","2"=>"Nhân viên 3"];
             @endphp
            <tr>
                <td>{{ $stt }}</td>
                <td>{{ $value['name'] }}</td>
                <td>{{ $value['password'] }}</td>
                <td>{{ $nhanviens[$value['nhanvienid']] }}</td>
                <td>{{ $value['nguoitao'] }}</td>              
                <td>{{ $value['nguoisua'] }}</td>
                <td>{{ $value['daxoa'] }}</td>
                <td><a href="{{ route('restoreDeletedUser', $value->id) }}" title="Khôi phục">
                    <i class="fas fa-window-restore text-success  fa-lg"></i>
                </a></td>
                <td> <a href="{{ route('deletePermanentlyUser', $value->id) }}" title="Xóa hoàn toàn">
                    <i class="fas fa-trash text-danger  fa-lg"></i>
                </a></td>
                
                        

            </tr>
            <?php
            endforeach;
            ?>

        </tbody>

    </table>
    {{-- <div class="d-flex justify-content-center">{{ $cauhinhs->onEachSide(1)->links() }}</div> --}}
    <!-- small modal -->

    

@endsection
