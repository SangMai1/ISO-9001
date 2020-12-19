@extends('layouts.master')

@section('title', 'Quản lý Users')
@section('pageName', 'Chỉnh sửa Users')

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
    <form method="post" action="{{route('user.update')}}">
      @csrf
      <input class="form-control" type="hidden" name="cid" value="{{$users['id']}}" /><br>
      <div class="form-group">
        <label>Name :</label>
        <input class="form-control" type="text" name="name" id="name" placehorder=" Nhập name" value="{{$users['name']}}" /><br>
        <span style="color:red">@error('name'){{ $message }}  @enderror</span>
      </div>

      <div class="form-group">
        <label>Password :</label>
        <input class="form-control" type="password" name="password" id="password" placehorder=" Nhập password" value="{{$users['password']}}" /><br>
        <span style="color:red">@error('password'){{ $message }}  @enderror</span>
      </div>
    
      <div class="form-group">
        <label>Nhân viên :</label>
        @php
        $nhanviens = ["0"=>"Nhân viên 1","1"=>"Nhân viên 2","2"=>"Nhân viên 3"];
      @endphp
        <select class="form-control" name="nhanvienid">
            @foreach($nhanviens as $key => $value)
              <option value="{{$key}}" {{$key == $users['nhanvienid'] ? 'selected' : ''}}>{{$value}}</option>
            @endforeach
          </select>
          {{-- <select class="form-control" name="nhanvienid">
            @foreach($nhanviens as $nv)
              <option value="{{$nv['id']}}" <?php echo ($users['nhanvienid'] == $nv['id'] ? 'selected' : '') ?>>{{$nv['ten']}}</option>
            @endforeach
          </select> --}}
      </div>

      

      <input class="btn btn-primary" type="submit" value="Cập nhật" />
            <a class="btn btn-primary" href="{{route('user.list')}}" role="button">Danh sách</a>
  </div>
</form>
@endsection