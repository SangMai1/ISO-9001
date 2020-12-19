@extends('layouts.master')
@section('title', 'Quản lý danh mục')
@section('pageName', 'Danh sách danh mục')

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

    {{-- Search --}}
    <form action="{{route('danhmuc.find')}}" method="GET">
        <div class="form-group">
            <label>Tên danh mục</label>
            <input class="form-control" type="text" name="tendm" value="{{$tendm ?? ""}}" /><br>
        </div>
        
        <div class="form-group">
            <label>Loại danh mục :</label>
            @php
              $loais = ["-1"=>"Chọn loại danh mục","0"=>"Chức danh","1"=>"Phòng ban","2"=>"Loại tài sản"];
            @endphp
            <select class="form-control" name="loaidm">
              @foreach($loais as $key => $value)
                <option value="{{$key}}" {{$key == $loaiDm ? 'selected' : ''}}>{{$value}}</option>
              @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Tìm kiếm</button>
    </form>

    <a href="{{route('danhmuc.add')}}" class="btn btn-primary">Thêm mới</a>

    <table class="table table-bordered table-hover">
        <tr>
          <th width="50px"><input class="sub_chk" type="checkbox" id="master"></th>
          <th>STT</th>
          <th>Mã</th>
          <th>Tên</th>
          <th>Loại</th>
        </tr>
        @foreach ($danhmucs as $item)
        <tr>
            <td><input type="checkbox" value={{$item->id}} name="idss[]"></td>
            <td>{{$item->id}}</td>
            <td>{{ $item->ma }}</td>
            <td>{{ $item->ten }}</td>
            <td>{{ $loais[$item->loai] }}</td>
            <td>
                <a  href="{{route('danhmuc.edit',["id"=>$item->id])}}"><i
                    class="fa fa-pencil-square-o mr-2" aria-hidden="true"></i></a>
                <a href="{{route('danhmuc.delete',["id"=>$item->id])}}"><i class="fa fa-trash-alt" aria-hidden="true" ></i></a>
            </td>
        </tr>
        @endforeach
      </table>
@endsection