@extends('layouts.master')
@section('title', 'Danh sách nhân viên')
@section('module', 'danh-sach')

@section('content')

    {{-- Search --}}
    <div class="d-flex">
        <div class="ml-auto">
            <form action="{{ route('nhanvien.search') }}" method="GET" class="m-0">
                <button type="submit" class="btn btn-sm btn-info btn-icon rounded-circle"><i class="fa fa-search"></i></button>
            </form>
        </div>
        <a href="{{ route('nhanvien.create') }}" class="btn btn-sm btn-info btn-icon rounded-circle"><i class="fas fa-plus-circle"></i></a>
        {{--
        <lengc /> --}}
    </div>
    <div class="table-region">
        @isset($message) <div class="alert">{{ $message }}</div> @endisset
        <x-table auto-index id="table-main" class="mobile" delete-href="{{ route('nhanvien.delete') }}" load-more="">
            @slot('head')
                <th class="th-mobile">Nhân viên</th>
                <th>Mã</th>
                <th>Tên</th>
                <th>Email</th>
                <th>Phòng</th>
                <th>Chức danh</th>
                <th class="th-action"><i class="fas fa-cogs"></i></th>
            @endslot
            @slot('body')
                @foreach ($nhanViens as $nv)
                    <tr data-id="{{ $nv->id }}">
                        {{-- @php dd($nv) @endphp --}}
                        <td class="td-mobile">
                            <a data-toggle="collapse" class="dropdown-toggle btn-info btn auto-icon">
                                <span class="cell no-title" index="2"></span>
                            </a>
                            <div class="collapse">
                                <div class="cell" index="1"></div>
                                <div class="cell" index="2"></div>
                                <div class="cell" index="3"></div>
                                <div class="cell" index="4"></div>
                                <div class="cell" index="5"></div>
                            </div>
                        </td>
                        <td>{{ $nv->ma }}</td>
                        <td>{{ $nv->ten }}</td>
                        <td>{{ $nv->email }}</td>
                        @isset($phongBans[$nv->phongbanid])
                            <td>{{ $phongBans[$nv->phongbanid] }}</td>
                        @else
                            <td empty></td>
                        @endisset
                        
                        @isset($chucDanhs[$nv->chucdanhid])
                            <td>{{ $chucDanhs[$nv->chucdanhid]}}</td>
                        @else
                            <td empty></td>
                        @endisset

                        <td class="td-action">
                            <button class="btn btn-sm btn-icon btn-danger rounded-circle delete-btn"><i class="fas fa-trash"></i></button>
                            <a class="btn btn-sm btn-info btn-icon rounded-circle" href="{{ route('nhanvien.edit') }}?id={{ $nv->id }}"><i class="fas fa-pencil-alt"></i></a>
                            <a class="btn btn-sm btn-info btn-icon rounded-circle" href="{{ route('usersvachucnangs.create') }}?id={{ $nv->id }}"><i class="fas fa-user-shield"></i></a>
                            <a class="btn btn-sm btn-info btn-icon rounded-circle" href="{{ route('usersvanhoms.create') }}?id={{ $nv->id }}"><i class="fas fa-users"></i></a>
                        </td>

                    </tr>
                @endforeach
            @endslot
        </x-table>
    </div>
@endsection
