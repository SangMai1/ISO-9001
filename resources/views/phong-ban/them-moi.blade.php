@extends('layouts.master')
@section('title', 'Thêm mới Phòng ban')
@section('content')
    <div id="active-menu" href="{{ route('phongBan.create') }}"></div>
    @include('message')

    <form method="post" autocomplete="off" ajax-form> 
        @csrf
        <x-input title="Mã Phòng Ban" type="text" name="ma" float />
        <x-input title="Tên Phòng ban" type="text" name="ten" float />
        <select title="Trưởng phòng" name="truongphong_nvid" autocomplete>
          @foreach ($nhanViens as $nv)
            <option value="{{$nv->id}}">{{$nv->ten}}</option>
          @endforeach
        </select>
        <x-input title="Ghi chú" type="textarea" name="ghichu" float rows="4"/>
        <button class="btn btn-info " type="submit">Thêm</button>
        <a class="btn btn-info" href="{{ route('phongBan.list') }}" role="button">Danh sách</a>
    </form>
    <script>
      $(()=>{
        $('[ajax-form]').validateCustom({
          rules: {
            'ma': {
              required: true,
            },
            'ten': {required: true},
          }
        })
      })
    </script>
@endsection}
