@extends('layouts.master')
@section('title', 'Cập nhật lịch xuất xe')


@section('content')

    <form method="post" action="{{ route('lichxuatxe.update') }}" ajax-form>
        @csrf
        <input type="hidden" name="id" value="{{ $lichxuatxe->id }}" />

        <div class="form-group">
            <label>Xe</label>
            <select title="" class="form-control" name="xeid">
                @foreach ($idXe as $key => $value)
                    <option value="{{ $key }}" {{ $key == $lichxuatxe['xeid'] ? 'selected' : '' }}>{{ $value }}</option>
                @endforeach
            </select>
        </div>

        <x-input title="Cuộc họp" type="text" name="cuochopid" value="{{ $lichxuatxe->cuochopid }}" float />

        <x-input title="Thời gian đi dự kiến" type="datetime-local" name="thoigiandidukien"
            value="{{ date('Y-m-d\TH:i:s', strtotime($lichxuatxe->thoigiandidukien)) }}"/>

        <x-input title="Thời gian về dự kiến" type="datetime-local" name="thoigianvedukien"
            value="{{ date('Y-m-d\TH:i:s', strtotime($lichxuatxe->thoigianvedukien)) }}" />

        <x-input title="Thời gian đi thực tế" type="datetime-local" name="thoigiandithucte" 
            value="{{ date('Y-m-d\TH:i:s', strtotime($lichxuatxe->thoigiandithucte)) }}"/>

        <x-input title="Thời gian về thực tế" type="datetime-local" name="thoigianvethucte" 
            value="{{ date('Y-m-d\TH:i:s', strtotime($lichxuatxe->thoigianvethucte)) }}"/>

        <x-input title="Số KM trước khi đi" type="number" name="sokmtruockhidi" value="{{ $lichxuatxe->sokmtruockhidi }}" float/>

        <x-input title="Số KM trước khi đi" type="text" name="sokmsaukhidi" value="{{ $lichxuatxe->sokmsaukhidi }}" float/>

        <div class="form-group">
            <label>Nhân viên</label>
            <select title="" class="form-control" name="nhanvienid">
                @foreach ($idNhanVien as $key => $value)
                    <option value="{{ $key }}" {{ $key == $lichxuatxe['nhanvienid'] ? 'selected' : '' }}>{{ $value }}
                    </option>
                @endforeach
            </select>
        </div>

        <x-input title="Địa điểm đi" type="text" name="diadiemdi" value="{{ $lichxuatxe->diadiemdi }}" float/>
        <div class="form-group">
            <label>Ghi chú</label>
            <textarea class="form-control" name="ghichu" rows="3">{{ $lichxuatxe->ghichu }}</textarea>
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
