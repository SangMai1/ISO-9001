@extends('layouts.master')
@section('title', 'Chuyển giao tài sản')


@section('content')

    <form method="post" action="{{ route('taisan.chuyengiao') }}" ajax-form>
        @csrf
        <input type="hidden" name="id" value="{{ $taisans->id }}" />

        <x-input title="Tên tài sản" value="{{ $taisans->tentaisan }}" float disabled />

        <x-input title="Thuộc sở hữu cá nhân / tổ chức" type="text" value="{{ $taisans->sohuu }}" disabled/>

        <div class="form-group">
        <label>Chuyển cho cá nhân / tổ chức</label>
        <select title="" class="form-control" name="sohuu" autocomplete>
          @foreach($soHuus as $key => $value)
            <option value="{{$value->ten}}">{{$value->ten}}</option>
          @endforeach
          <option value="Không thuộc bất kì ai">Không thuộc bất kì ai</option>
        </select>
      </div>

        <input class="btn btn-sm btn-info" type="submit" value="Cập nhật" />


    </form>
@endsection
