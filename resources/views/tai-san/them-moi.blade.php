@extends('layouts.master')
@section('title', 'Thêm mới tài sản')
@section('module', 'tai-san/chuyen-giao') 
@section('content')
  @include('message')
  
    <form method="post" autocomplete="off" ajax-form>
      @csrf

      <x-input class="ma" type="hidden" name="mataisan"/>
      <x-input title="Tên tài sản" type="text" name="tentaisan"/>
      
      <div class="form-group" id="allTaiSan">
        <label>Loại tài sản</label>
        <select title="" class="form-control" name="loaitaisanid" autocomplete>
          @foreach($danhMucs as $key => $value)
            <option value="{{$key}}">{{$value}}</option>
          @endforeach
        </select>
      </div>
      <div id="tagsname"></div>
      <div class="form-group">
            <label>Chuyển cho cho đơn vị</label>
            <div class="icc">
                <x-input title="Cho phòng ban" type="radio" name="sohuu_type" value="1" float />
                <x-input title="Cho người dùng" type="radio" name="sohuu_type" value="2" float />
                <x-input title="Thu hồi quyền sở hữu" type="radio" name="sohuu_type" value="" float />
            </div>

            <div>
                <div class="sohuu-type" i="1">
                    <select title="Phòng ban" class="form-control" name="sohuu_id" autocomplete>
                        @foreach ($phongBans as $id => $ten)
                            <option value="{{ $id }}">{{ $ten }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="sohuu-type" i="2">
                    <select title="Nhân viên" class="form-control" name="sohuu_id" autocomplete>
                        @foreach ($nhanViens as $id => $ten)
                            <option value="{{ $id }}">{{ $ten }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
      

      <x-input title="Giá tiền" type="number" name="giatien"/>

      <x-input title="Mới" type="radio" name="trangthai" value="0" checked float/> <!-- 0: Mới -->
      <x-input title="Đã qua sử dụng" type="radio" name="trangthai" value="1" float/> <!-- 1: Đã qua sử dụng -->

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
                    },
                    giatien: {
                        required: true
                    },
                    khauhao: {
                        required: true
                    }
                }
            });

            $('.is-filled > .input-complete').on('autocompletechange change', function () {
                
                var firstString = function(s){
                  return s.match(/\b(\w)/g).join('').toUpperCase();
                }
                var str = firstString(this.value);
                $('.ma').val(str);
                
                
            }).change();

        });
            
        
  </script>
@endsection