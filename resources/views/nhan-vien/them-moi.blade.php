@extends('layouts.master')

@section('title', 'Quản lý nhân viên')
@section('pageName', 'Thêm mới nhân viên')
@section('module','nhanvien/render')

@section('content')
<?php //Hiển thị thông báo thành công?>
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

<?php //Form thêm mới học sinh?>
    <form method="post" action="{{route('nhanvien.save')}}">
      {{csrf_field()}}

      <x-input title="Tên" type="text" name="ten" onchange="render()" id="ten" float/>
      <x-input title="Mã" type="text" name="ma" float/>
      <x-input title="Email" type="email" name="email" float/>

      <x-input title="Nam" type="radio" name="gioitinh" value="0" checked float/>
      <x-input title="Nữ" type="radio" name="gioitinh" value="1" float/>
      <x-input title="Khác" type="radio" name="gioitinh" value="2" float /><br>

      <x-input title="Hệ số lương" type="number" name="hesoluong" float/>
      <x-input title="Ngày sinh" type="date" name="ngaysinh"/>

      <div class="form-group">
        <label>Chức danh </label>
        <select title="" class="form-control" name="chucdanhid">
          @foreach($chucdanhs as $key => $value)
            <option value="{{$key}}">{{$value}}</option>
          @endforeach
        </select>
      </div>

      <div class="form-group">
        <label>Phòng ban </label>
        <select class="form-control" name="phongbanid">
          @foreach($phongbans as $key => $value)
            <option value="{{$key}}">{{$value}}</option>
          @endforeach
        </select>
      </div>

      <x-input title="Tên đăng nhập" type="text" name="username" id="username" float/>
      <x-input title="Mật khẩu" type="password" name="password" id="password" float/>

      <input class="btn btn-primary" type="submit" value="Thêm" />
  </div>
</form>
@endsection