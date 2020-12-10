@extends('layouts.master')

@section('title', 'Quản lý cấu hình')
@section('pageName', 'Chỉnh sửa cấu hình')

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
    <form method="post" action="{{ url('/cau-hinh/cap-nhat') }}">
      {{csrf_field()}}
      <input class="form-control" type="hidden" name="id" value="{{$cauhinh['id']}}" /><br>
      <div class="form-group">
        <label>Mã :</label>
        <input class="form-control" type="text" name="ma" id="ma" placehorder=" Nhập mã" value="{{$cauhinh['ma']}}" /><br>
      </div>

      <div class="form-group">
        <label>Tên :</label>
        <input class="form-control" type="text" name="ten" id="ten" placehorder=" Nhập tên" value="{{$cauhinh['ten']}}" /><br>
      </div>
    
      <div class="form-group">
        <label>Giá trị :</label>
        <input class="form-control" type="text" name="giatri" id="giatri" placehorder=" Nhập giá trị" value="{{$cauhinh['giatri']}}" /><br>
      </div>

      <div class="form-group">
        <label>Người sửa :</label>
        <input class="form-control" type="text" name="nguoisua" id="nguoisua" placehorder=" Nhập người sửa" value="{{$cauhinh['nguoisua']}}" /><br>
      </div>
      

      <input class="btn btn-primary" type="submit" value="Cập nhật" />
            <a class="btn btn-primary" href="/cau-hinh/danh-sach" role="button">Danh sách</a>
  </div>
</form>
@endsection