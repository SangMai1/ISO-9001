@extends('layouts.master')
@section('title', 'Cập nhật tài sản')


@section('content')

    <form method="post" action="{{ route('taisan.update') }}" ajax-form>
        @csrf
        <input type="hidden" name="id" value="{{ $taisans->id }}" />

        <x-input title="Mã tài sản" type="text" name="mataisan" value="{{ $taisans->mataisan }}" float />

        <x-input title="Tên tài sản " type="text" name="tentaisan" value="{{ $taisans->tentaisan }}" float />



        <div class="form-group">
            <label>Loại tài sản </label>
            <select title="" class="form-control" name="loaitaisanid" autocomplete>
                @foreach ($danhMucs as $key => $value)
                    <option value="{{ $key }}" {{ $key == $taisans->loaitaisanid ? 'selected' : '' }}>{{ $value }}</option>
                @endforeach
            </select>
        </div>

        <x-input title="Giá tiền" type="number" name="giatien" value="{{ $taisans->giatien }}" />

        <x-input title="Còn zin" type="radio" name="trangthai" value="0" :checked="$taisans['trangthai'] == 0 " float />
        <!-- 0: Mới -->
        <x-input title="Mất zin" type="radio" name="trangthai" value="1" :checked="$taisans['trangthai'] == 1 " float />
        <!-- 1: Đã qua sử dụng -->

        <x-input title="Khấu hao" type="number" name="khauhao" value="{{ $taisans->khauhao }}" />

        <input class="btn btn-sm btn-info" type="submit" value="Cập nhật" />


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
