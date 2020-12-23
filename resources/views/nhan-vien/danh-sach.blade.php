@extends('layouts.master')
@section('title', 'Danh sách nhân viên')
@section('module','danh-sach')

@section('content')
    <a href="{{route('nhanvien.add')}}" class="btn btn-sm btn-info btn-icon rounded-circle" style="float: right"><i class="fas fa-plus-circle"></i></a>
    <button class="btn btn-sm btn-info btn-icon rounded-circle viewFind" style="float: right"><i class="fa fa-search"></i></button>

    {{-- Search --}}
    <div class="viewForm">
        <form action="{{route('nhanvien.find')}}" method="GET">
            <button type="submit" class="btn btn-primary">Tìm kiếm</button>
        </form>
    </div>

    <div class="table-region">
        @isset($message) <div class="alert">{{ $message }}</div> @endisset
        <x-table auto-index id="table-main" class="mobile" delete-href="{{ route('nhanvien.delete') }}">
            @slot('head')
                <th class="th-mobile">Nhân viên</th>
                <th>Mã</th>
                <th>Tên</th>
                <th>Email</th>
                <th>Phòng ban</th>
                <th>Chức danh</th>
                <th class="th-action"><i class="fas fa-cogs"></i></th>
            @endslot
            @slot('body')
                @foreach ($nhanViens as $item)
                    <tr data-id="{{ $item->id }}">
                        <td class="td-mobile">
                            <a data-toggle="collapse" class="dropdown-toggle btn-info btn auto-icon">
                                <span class="cell no-title" index="2" ></span>
                            </a>
                            <div class="collapse">
                                <div class="cell" index="1"></div>
                                <div class="cell" index="2"></div>
                                <div class="cell" index="3"></div>
                                <div class="cell" index="4"></div>
                                <div class="cell" index="5"></div>
                            </div>
                        </td>
                        <td>{{ $item->ma }}</td>
                        <td>{{ $item->ten }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $phongBans[$item->phongbanid] }}</td>
                        <td>{{ $chucDanhs[$item->chucdanhid] }}</td>
                        <td class="td-action">
                            <button class="btn btn-sm btn-icon btn-danger rounded-circle delete-btn"><i class="fas fa-trash"></i></button>
                            <a class="btn btn-sm btn-info btn-icon rounded-circle" 
                            href="{{ route('nhanvien.edit') }}"><i class="fas fa-pencil-alt"></i></a>
                        </td>

                    </tr>
                @endforeach
            @endslot
        </x-table>
    </div> 
@endsection