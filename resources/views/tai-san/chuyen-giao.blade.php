@extends('layouts.master')
@section('title', 'Chuyển giao tài sản')
@section('module', 'tai-san/chuyen-giao') 

@section('content')

    <form method="post" action="{{ route('taisan.chuyengiao') }}" ajax-form>
        @csrf
        <input type="hidden" name="id" value="{{ $taisans->id }}" />

        <x-input title="Tên tài sản" value="{{ $taisans->tentaisan }}" float disabled />

        <x-input title="Thuộc sở hữu cá nhân / tổ chức" type="text" value="{{ $taisans->sohuu }}" disabled />

        <div class="form-group">
            <label>Chuyển cho cho đơn vị</label>
            <div class="icc">
                <x-input title="Cho phòng ban" type="radio" name="sohuu_type" value="1" float :checked="$taisans->sohuu_type == 1" />
                <x-input title="Cho người dùng" type="radio" name="sohuu_type" value="2" float :checked="$taisans->sohuu_type == 2" />
                <x-input title="Thu hồi quyền sở hữu" type="radio" name="sohuu_type" value="" float :checked="$taisans->sohuu_type == null" />
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

        <input class="btn btn-sm btn-info" type="submit" value="Cập nhật" />


    </form>
@endsection
