@extends('layouts.master')
@section('title', 'Thêm mới lịch xuất xe')
@section('content')
  @include('message')
  
    <form method="post" autocomplete="off" ajax-form>
      @csrf
      
      <div class="form-group">
        <label>Xe</label>
        <select title="" class="form-control" name="xeid">
          @foreach($idXe as $key => $value)
            <option value="{{$key}}">{{$value}}</option>
          @endforeach
        </select>
      </div>

      <x-input title="Cuộc họp" type="text" name="cuochopid" float/>

      <x-input title="Thời gian đi dự kiến" type="datetime-local" name="thoigiandidukien"/>

      <x-input title="Thời gian về dự kiến" type="datetime-local" name="thoigianvedukien"/>


      <div class="form-group">
        <label>Nhân viên</label>
        <select title="" class="form-control" name="nhanvienid">
          @foreach($idNhanVien as $key => $value)
            <option value="{{$key}}">{{$value}}</option>
          @endforeach
        </select>
      </div>
      <x-input title="Địa điểm đi" type="text" name="diadiemdi" float/>
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
                    thoigiandidukien: {
                        required: true
                    },
                    thoigianvedukien: {
                        required: true
                    },
                    diadiemdi: {
                      required: true,
                      minlength: 1
                    },
                    ghichu: {
                      required: true,
                      minlength: 1
                    }
                }
            });
        });
  </script>
@endsection