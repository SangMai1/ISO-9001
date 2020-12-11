@extends('layouts.master')
@section('title', 'Quản lý chức năng')
@section('pageName', 'Danh sách chức năng')

@section('content')
  <div class="container">
    <!-- Alert message (start) -->
        @if(Session::has('message'))
        <div class="alert {{ Session::get('alert-class') }}">
          {{ Session::get('message') }}
        </div>
        @endif
        <!-- Alert message (end) -->
    
    <form method=get action="<?= route("viewChucNang") ?>">
      <table class="table table-bordered table-hover">
        <tr>
          <th width="50px"><input type="checkbox" id="master"></th>
          <th>STT</th>
          <th>Tên</th>
          <th>URL</th>
          <th>Select</th>
        </tr>
        @foreach($chucNangs as $cn)
        <tr>
          <td><input type="checkbox"  ></td>
          <td>
            {{$cn->id}}
          </td>
          <td>
            {{$cn->ten}}
          </td>
          <td>
            {{$cn->url}}
          </td>
          <td>
            <a href="{{ route('edit',[$cn->id]) }}">Edit</a>
            <a href="{{ route('xoa',[$cn->id]) }}">Delete</a>
          </td>
        </tr>
        @endforeach
      </table>
    </form>

  </div>

@endsection
