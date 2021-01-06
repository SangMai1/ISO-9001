@extends('layouts.master')
@section('title', 'Thêm mới lịch sử sửa chữa')
@section('content')
  @include('message')
  
    <form method="post" autocomplete="off" ajax-form>
      @csrf
      
      
      <x-input title="Tài sản" type="text" name="taisanid" value="{{$idTaiSan[$xe->taisanid]}}" float/>

      <x-input title="Ngày đi sửa" type="datetime-local" name="thoigiansua"/>

      <x-input title="Giá tiền" type="number" name="giatien" float/>


      <div class="form-group">
        <label>Nhân viên</label>
        <select title="" class="form-control" name="nguoidisua">
          @foreach($idNhanVien as $key => $value)
            <option value="{{$key}}">{{$value}}</option>
          @endforeach
        </select>
      </div>

      <div class="form-group">
        <label>Ghi chú</label>
        <textarea class="form-control" name="ghichu" rows="3"></textarea>
      </div>
      <input class="btn btn-sm btn-info" type="submit" value="Lưu" />
  </div>
</form>
 <script>
        $(() => {
            $('form[ajax-form]').validateCustom({
                rules: {
                    thoigiansua: {
                        required: true
                    },
                    giatien: {
                        required: true,
                        minlength: 3
                    },
                    ghichu: {
                      required: true,
                      minlength: 1
                    }
                }
            })
        });
  </script>
@endsection