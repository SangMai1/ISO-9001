@extends('layouts.master')

@section('title', 'Quản lý cấu hình')
@section('pageName', 'Chỉnh sửa cấu hình')

@section('content')
@if (Session::get('success'))
        <div class="alert alert-success">
           {{Session::get('success')}}
        </div>
    @endif
    @if (Session::get('fail'))
        <div class="alert alert-danger">
           {{Session::get('fail')}}
        </div>
    @endif
    <br>
    <form method="post" action="{{ url('/cau-hinh/cap-nhat') }}">
      @csrf
      <input class="form-control" type="hidden" name="cid" value="{{$cauhinh['id']}}" /><br>
      <div class="form-group">
        <label>Mã :</label>
        <input class="form-control" type="text" name="ma" id="ma" placehorder=" Nhập mã" value="{{$cauhinh['ma']}}" /><br>
        <span style="color:red">@error('ma'){{ $message }}  @enderror</span>
      </div>

      <div class="form-group">
        <label>Tên :</label>
        <input class="form-control" type="text" name="ten" id="ten" placehorder=" Nhập tên" value="{{$cauhinh['ten']}}" /><br>
        <span style="color:red">@error('ten'){{ $message }}  @enderror</span>
      </div>
    
      <div class="form-group">
        <label>Giá trị :</label>
        <input class="form-control" type="text" name="giatri" id="giatri" placehorder=" Nhập giá trị" value="{{$cauhinh['giatri']}}" /><br>
        <span style="color:red">@error('giatri'){{ $message }}  @enderror</span>
      </div>

      <div class="form-group">
        <label>Người sửa :</label>
        <input class="form-control" type="text" name="nguoisua" id="nguoisua" placehorder=" Nhập người sửa" value="{{$cauhinh['nguoisua']}}" /><br>
        <span style="color:red">@error('nguoisua'){{ $message }}  @enderror</span>
      </div>
      

      <input class="btn btn-primary" type="submit" value="Cập nhật" />
            <a class="btn btn-primary" href="/cau-hinh/danh-sach" role="button">Danh sách</a>
  </div>
</form>
@endsection