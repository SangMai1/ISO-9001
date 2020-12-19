@extends('layouts.master')
@section('title', 'Quản lý Users')
@section('pageName', 'Danh sách Users')
    
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
            <a class="btn btn-light" href="{{ route('getDeleteUsers')}}" style="margin-bottom: 10px" title="Cấu hình đã xóa"> <i class="fas fa-recycle"></i></a>
            <input class="btn btn-success" type="submit" name="submit" value="Xóa tất cả"/>
        </div>
        <div class="col-md-4">
            <form action="{{ route('user.search') }}" method="GET">
                <div class="input-group">
                    <input type="search" name="search" class="form-control">
                    <span class="input-group-prepend">
                        <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                    </span>
                </div>
            </form>
        </div>
        <div class="col-md-2 text-right">
            <a href="{{route('user.create')}}" style="margin-bottom: 10px" class="btn btn-primary">Thêm mới</a>
        </div>
    </div>
    <x-table auto-index select id="table-component-table">
        @slot('head')
                <th>Name</th>
                <th>Password</th>
                <th>Nhân viên</th>
                <th>Người tạo</th>
                <th>Ngày tạo</th>
                <th>Người sửa</th>
                <th>Ngày sửa</th>
                <th>Action</th>        
        @endslot
        @slot('body')
            @php
            $nhanviens = ["0"=>"Nhân viên 1","1"=>"Nhân viên 2","2"=>"Nhân viên 3"];
            @endphp
            @foreach ($users as $value)
            <tr data-id="{{ $value['id'] }}">
            
                <td>{{ $value['name'] }}</td> 
                <td>{{ $value['password'] }}</td>
                <td>{{ $nhanviens[$value['nhanvienid']] }}</td>
                {{-- <td><?php echo App\Models\nhanviens::find($value['id'])->ten ?></td> --}}
                <td>{{ $value['nguoitao'] }}</td>
                <td>{{ $value['created_at'] }}</td>
                <td>{{ $value['nguoisua'] }}</td>
                <td>{{ $value['updated_at'] }}</td>
                <td>
                       
                    <a href="{{ route('user.edit', $value->id) }}"  title="Chỉnh sửa" style="color: none; ">
                        <i class="fa fa-pencil-square-o text-success" aria-hidden="true" ></i></a>    
                    <a href="{{route('user.destroy',$value->id)}}" title="Xóa" style="color: red> ">
                        <i class="fa fa-trash-alt" aria-hidden="true" ></i></a>
                    </td>
            </tr>
            @endforeach

        @endslot

    </x-table>
   

@endsection
