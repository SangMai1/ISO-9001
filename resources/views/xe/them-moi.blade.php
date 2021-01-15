@extends('layouts.master')
@section('title', 'Thêm mới xe')
@section('content')
  @include('message')
  
    <form method="post" autocomplete="off" ajax-form>
      @csrf
      
      <div class="form-group">
        <label>Tài sản</label>
        <select title="" class="form-control" name="taisanid" autocomplete>
          @foreach($idTaiSan as $key => $value)
            <option value="{{$key}}">{{$value}}</option>
          @endforeach
        </select>
      </div>

      <x-input title="Biển số" type="text" name="bienso" float />

      <x-input title="Số chỗ" type="number" name="socho" min="1" float/>

      <div class="form-group">
        <label>Nhân viên</label>
        <select title="" class="form-control" name="nhanvienid" autocomplete>
          @foreach($idNhanVien as $key => $value)
            <option value="{{$key}}">{{$value}}</option>
          @endforeach
        </select>
      </div>

      <input class="btn btn-sm btn-info" type="submit" value="Lưu" />
  </div>
</form>
 <script>
        $(() => {
            $('form[ajax-form]').validateCustom({
                rules: {
                    bienso: {
                        required: true,
                        minlength: 5
                    },
                    socho: {
                        required: true,
                        minlength: 1
                    }
                }
            });

            
        });        

  </script>
@endsection