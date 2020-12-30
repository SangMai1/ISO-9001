@extends('layouts.master')
@section('title', 'Cập nhật lịch sử sửa chữa')


@section('content')

    <form method="post" action="{{ route('lichsusuachua.update') }}" ajax-form>
        @csrf
        <input type="hidden" name="id" value="{{ $lichsusuachua->id }}" />

        <div class="form-group">
            <label>Tài sản</label>
            <select title="" class="form-control" name="taisanid">
                @foreach ($idTaiSan as $key => $value)
                    <option value="{{ $key }}" {{ $key == $lichsusuachua['taisanid'] ? 'selected' : '' }}>{{ $value }}
                    </option>
                @endforeach
            </select>
        </div>

        <x-input title="Ngày đi sửa" type="datetime-local" name="thoigiansua"
            value="{{ date('Y-m-d\TH:i:s', strtotime($lichsusuachua->thoigiansua)) }}" />

        <x-input title="Giá tiền" type="number" name="giatien" value="{{ $lichsusuachua->giatien }}" float />

        <div class="form-group">
            <label>Nhân viên</label>
            <select title="" class="form-control" name="nguoidisua">
                @foreach ($idNhanVien as $key => $value)
                    <option value="{{ $key }}" {{ $key == $lichsusuachua['nguoidisua'] ? 'selected' : '' }}>{{ $value }}
                    </option>
                @endforeach
            </select>
        </div>
        
        <div class="form-group">
            <label>Ghi chú</label>
            <textarea class="form-control" name="ghichu" rows="3">{{ $lichsusuachua->ghichu }}</textarea>
        </div>
        <input class="btn btn-sm btn-info" type="submit" value="Cập nhật" />


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
