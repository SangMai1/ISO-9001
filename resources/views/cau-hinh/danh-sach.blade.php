@extends('layouts.master')
@section('title', 'Quản lý cấu hình')
@section('pageName', 'Danh sách cấu hình')

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
<div class="container">
    <?php
    ?>
        <th><a href="/cau-hinh/them-moi" class="btn btn-primary">Thêm mới</a></th>
    <table class="table table-bordered table-hover"><br><br>
        {{-- <x-inputs.checkbox name="">
            @slot('content') @endslot
        </x-inputs.checkbox>
        <x-inputs.input title="Email" type="text" name="name" error="cscs"></x-inputs.input> --}}
        <thead>
            <tr>
                <th width="50px"><input type="checkbox" id="master"></th>
                <th>Stt</th>
                <th>Mã</th>
                <th>Tên</th>
                <th>Giá trị</th>
                <th>Người tạo</th>
                <th>Ngày tạo</th>
                <th>Người sửa</th>
                <th>Ngày sửa</th>
                

            </tr>
        </thead>
        <tbody>
            <?php
            $stt = 0;
            foreach ($cauhinh as $value) : $stt++
            ?>
                <tr>
                    <td><input type="checkbox"  ></td>
                    <td>{{$stt}}</td>
                    <td>{{ $value['ma']}}</td>
                    <td>{{ $value['ten']}}</td>
                    <td>{{ $value['giatri']}}</td>
                    <td>{{ $value['nguoitao']}}</td>
                    <td>{{ $value['ngaytao']}}</td>
                    <td>{{ $value['nguoisua']}}</td>
                    <td>{{ $value['ngaysua']}}</td>

                    <td>
                        <a  href="/cau-hinh/{{$value['id']}}/chinh-sua"><i
                       class="fa fa-pencil-square-o mr-2" aria-hidden="true"></i></a>
                     <a href="/cau-hinh/{{$stt}}/xoa"><i class="fa fa-trash-alt" aria-hidden="true" ></i></a>
                    </td>
                   
                </tr>
                <?php endforeach ?>
            
        </tbody>
    </table>
</div>
@endsection