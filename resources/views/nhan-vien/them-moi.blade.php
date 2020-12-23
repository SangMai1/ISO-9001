@extends('layouts.master')
@section('title', 'Thêm mới nhân viên')
@section('module','nhanvien/render')

@section('content')
  @include('message')
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