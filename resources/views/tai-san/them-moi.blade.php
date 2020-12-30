@extends('layouts.master')
@section('title', 'Thêm mới tài sản')
@section('content')
  @include('message')
  
    <form method="post" autocomplete="off" ajax-form>
      @csrf

      <x-input title="Mã tài sản" type="text" name="mataisan" float/>
      <x-input title="Tên tài sản" type="text" name="tentaisan"/>
      
      <div class="form-group">
        <label>Loại tài sản</label>
        <select title="" class="form-control" name="loaitaisanid">
          @foreach($danhMucs as $key => $value)
            <option value="{{$key}}">{{$value}}</option>
          @endforeach
        </select>
      </div>

      <x-input title="Giá tiền" type="number" name="giatien"/>

      <x-input title="Còn zin" type="radio" name="trangthai" value="0" checked float/> <!-- 0: Mới -->
      <x-input title="Mất zin" type="radio" name="trangthai" value="1" float/>          <!-- 1: Đã qua sử dụng -->

      <x-input title="Khấu hao" type="number" name="khauhao"/>

      

      <input class="btn btn-sm btn-info" type="submit" value="Lưu" />
  </div>
</form>
 <script>
        $(() => {
            $('form[ajax-form]').validateCustom({
                rules: {
                    mataisan: {
                        required: true,
                        minlength: 1
                    },
                    tentaisan: {
                        required: true,
                        minlength: 3
                    }
                }
            })
        });
  </script>
@endsection