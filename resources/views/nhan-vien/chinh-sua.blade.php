@extends('layouts.master')

@section('title', 'Quản lý nhân viên')
@section('pageName', 'Chỉnh sửa nhân viên')

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
    <form method="post" action="{{route('nhanvien.update')}}">
      {{csrf_field()}}
      <input class="form-control" type="hidden" name="id" value="{{$nhanvien['id']}}" /><br>
      <x-input title="Tên" type="text" name="ten" onchange="render()" id="ten" value="{{$nhanvien['ten']}}" float/>
      <x-input title="Mã" type="text" name="ma" float value="{{$nhanvien['ma']}}"/>
      <x-input title="Email" type="email" name="email" value="{{$nhanvien['email']}}" float/>

      <x-input title="Nam" type="radio" name="gioitinh" value="0" :checked="$nhanvien['gioitinh'] == 0" float/>
      <x-input title="Nữ" type="radio" name="gioitinh" value="1" :checked="$nhanvien['gioitinh'] == 1" float/>
      <x-input title="Khác" type="radio" name="gioitinh" value="2" :checked="$nhanvien['gioitinh'] == 2" float />

      <x-input title="Hệ số lương" type="number" name="hesoluong" value="{{$nhanvien['hesoluong']}}" float/>
      <x-input title="Ngày sinh" type="date" name="ngaysinh" value="{{$nhanvien['ngaysinh']}}"/>

      <div class="form-group">
        <label>Chức danh </label>
        <select title="" class="form-control" name="chucdanhid">
          @foreach($chucdanhs as $key => $value)
            <option value="{{$key}}" {{$key == $nhanvien['chucdanhid'] ? 'selected':''}}>{{$value}}</option>
          @endforeach
        </select>
      </div>

      <div class="form-group">
        <label>Phòng ban </label>
        <select class="form-control" name="phongbanid">
          @foreach($phongbans as $key => $value)
            <option value="{{$key}}" {{$key == $nhanvien['phongbanid'] ? 'selected':''}}>{{$value}}</option>
          @endforeach
        </select>
      </div>

      <input class="btn btn-primary" type="submit" value="Cập nhật" />
  </div>
</form>
@endsection