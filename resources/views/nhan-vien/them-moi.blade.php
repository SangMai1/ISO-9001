@extends('layouts.master')
@section('title', 'Thêm mới nhân viên')
@section('module', 'nhanvien/render')
@section('content')
  @include('message')
  
    <form method="post" autocomplete="off" ajax-form>
      @csrf

      <x-input title="Tên" type="text" name="ten" id="ten" onblur="render()" float/>
      <x-input title="Mã" type="text" name="ma" id="ma"/>
      <x-input title="Email" type="email" name="email" id="email"/>

      <x-input title="Nam" type="radio" name="gioitinh" value="0" checked float/>
      <x-input title="Nữ" type="radio" name="gioitinh" value="1" float/>
      <x-input title="Khác" type="radio" name="gioitinh" value="2" float /><br>

      <x-input title="Hệ số lương" type="number" name="hesoluong" float/>
      <x-input title="Ngày sinh" type="date" name="ngaysinh"/>

      <div class="form-group">
        <label>Chức danh </label>
        <select title="" class="form-control" name="chucdanhid" id="chucdanh">
          @foreach($chucDanhs as $key => $value)
            <option value="{{$key}}">{{$value}}</option>
          @endforeach
        </select>
      </div>

      <div class="form-group">
        <label>Phòng ban </label>
        <select class="form-control" name="phongbanid" id="phongban">
          @foreach($phongBans as $key => $value)
            <option value="{{$key}}">{{$value}}</option>
          @endforeach
        </select>
      </div>

      <x-input title="Mật khẩu" type="password" name="password" id="password"/>

      <input class="btn btn-sm btn-info" type="submit" value="Lưu" />
  </div>
</form>
<script>
function render() {
  var formData = new FormData();
  formData.append("_token", $("input[name=_token]").val());
  formData.append("ten", $('#ten').val());
  $.ajax({
    type: 'POST', 
    url: "{{route('nhanvien.render')}}", 
    data: formData, 
    dataType: "json",
    success: function (data) {
      var json = JSON.parse(data);
      Swal.close();
      $("#email").val(json.username);
      $("#ma").val(json.ma);
      $("#password").val(json.password);
    }
  });
}
</script>
@endsection