@extends('layouts.master')

@section('title', 'Quản lý cấu hình')
@section('pageName', '')

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
  <x-card>
    @slot('title') Thêm mới cấu hình @endslot 
    @slot('body')
    <form method="post" action="{{ url('/cau-hinh/luu') }}">
      {{csrf_field()}}
        
      <div class="form-group">
        <label >Mã :</label>
        <input class="form-control" type="text" name="ma" id="ma" placehorder=" Nhập mã" /><br>
      <span style="color:red">@error('ma'){{ $message }}  @enderror</span>
      </div>

      <div class="form-group">
        <label>Tên :</label>
        <input class="form-control" type="text" name="ten" id="ten" placehorder=" Nhập tên" /><br>
        <span style="color:red">@error('ten'){{ $message }}  @enderror</span>
      </div>
    
      <div class="form-group">
        <label>Giá trị :</label>
        <input class="form-control" type="text" name="giatri" id="giatri" placehorder=" Nhập giá trị" /><br>
        <span style="color:red">@error('giatri'){{$message}} @enderror</span>
      </div>

      <div class="form-group">
        <label>Người tạo :</label>
        <input class="form-control" type="text" name="nguoitao" id="nguoitao" placehorder=" Nhập người tạo" /><br>
        <span style="color:red">@error('nguoitao'){{$message}} @enderror</span>
      </div>
      

      <input class="btn btn-primary" type="submit" value="Thêm" />
            <a class="btn btn-primary" href="/cau-hinh/danh-sach" role="button">Danh sách</a>
  </div>
</form>
@endslot
  </x-card>
@endsection