@extends('layouts.master')
@section('title', 'Cập nhật xe')


@section('content')

    <form method="post" action="{{ route('xe.update') }}" ajax-form>
        @csrf
        <input type="hidden" name="id" value="{{ $xe->id }}" />

        <div class="form-group">
            <label>Tài sản</label>
            <select title="" class="form-control" name="taisanid" autocomplete >
                @foreach ($idTaiSan as $key => $value)
                    <option value="{{ $key }}" {{ $key == $xe['taisanid'] ? 'selected' : '' }}>{{ $value }}</option>
                @endforeach
            </select>
        </div>

        <x-input title="Biển số" type="text" name="bienso" value="{{ $xe->bienso }}" float />

        <x-input title="Số chỗ" type="number" name="socho" value="{{ $xe->socho }}" float />

        <div class="form-group">
            <label>Nhân viên</label>
            <select title="" class="form-control" name="nhanvienid" autocomplete>
                @foreach ($idNhanVien as $key => $value)
                    <option value="{{ $key }}" {{ $key == $xe['nhanvienid'] ? 'selected' : '' }}>{{ $value }}</option>
                @endforeach
            </select>
        </div>

        <input class="btn btn-sm btn-info" type="submit" value="Cập nhật" />


    </form>
    <script>
        $(() => {
            $('form[ajax-form]').validateCustom({
                rules: {
                    bienso: {
                        required: true,
                        minlength: 3
                    },
                    socho: {
                        required: true,
                        minlength: 1
                    }
                }
            })
        });

    </script>
@endsection
