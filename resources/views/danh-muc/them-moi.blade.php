@extends('layouts.master')

@section('title', 'Quản lý danh mục')
@section('pageName', 'Thêm mới danh mục')

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

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          <span class="sr-only">Đóng</span>
        </button>
    </div>
@endif

<?php //Form thêm mới học sinh?>
    <form method="post" action="{{route('danhmuc.save')}}">
      {{csrf_field()}}
        
      <div class="form-group">
        <label>Mã :</label>
        <input class="form-control" type="text" name="ma" id="ma" placehorder=" Nhập mã" /><br>
      </div>

      <div class="form-group">
        <label>Tên :</label>
        <input class="form-control" type="text" name="ten" id="ten" placehorder=" Nhập tên" /><br>
      </div>
    
      <div class="form-group">
        <label>Loại :</label>
        @php
          $loais = ["0"=>"Chức danh","1"=>"Phòng ban","2"=>"Loại tài sản"];
        @endphp
        <select class="form-control" name="loai">
          @foreach($loais as $key => $value)
            <option value="{{$key}}">{{$value}}</option>
          @endforeach
        </select>
     </div>

      <input class="btn btn-primary" type="submit" value="Thêm" />
            <a class="btn btn-primary" href="{{route('danhmuc.list')}}" role="button">Danh sách</a>
  </div>
</form>
@endsection