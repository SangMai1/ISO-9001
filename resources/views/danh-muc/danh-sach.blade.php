@extends('layouts.master')
@section('title', 'Danh sách danh mục')
@section('module', 'danh-sach')

@section('content')
    <div id="active-menu" href="{{ route('danhmuc.list') }}?loai=1" ></div>
    <div id="active-menu" href="{{ route('danhmuc.list') }}?loai=0" ></div>
    <div id="active-menu" href="{{ route('danhmuc.list') }}?loai=2" ></div>
    <a href="{{route('danhmuc.create')}}?loai={{$loaiDm}}" class="btn btn-sm btn-info btn-icon rounded-circle" style="float: right"><i class="fas fa-plus-circle"></i></a>
    <button class="btn btn-sm btn-info btn-icon rounded-circle viewFind" style="float: right"><i class="fa fa-search"></i></button><br>

    {{-- Search --}}
    <div class="viewForm">
        <form action="{{route('danhmuc.search')}}" method="get">
            <x-input title="Tên danh mục" type="text" name="tendm" id="tendm" value="{{ $tendm }}" float/>
            <x-input title="" type="hidden" name="loaidm" value="{{$loaiDm}}"/>
    
            <button type="submit" class="btn btn-sm btn-info btn-icon rounded-circle"><i class="fa fa-search"></i></button>
        </form>
    </div>

    <div class="table-region">
        @isset($message) <div class="alert">{{ $message }}</div> @endisset
        <x-table auto-index id="table-main" class="mobile" delete-href="{{ route('danhmuc.delete') }}" load-more="">
            @slot('head')
                <th class="th-mobile">Danh mục</th>
                <th>Mã</th>
                <th>Tên</th>
                <th class="th-action"><i class="fas fa-cogs"></i></th>
            @endslot
            @slot('body')
                @foreach ($danhMucs as $item)
                    <tr data-id="{{ $item->id }}">
                        <td class="td-mobile">
                            <a data-toggle="collapse" class="dropdown-toggle btn-info btn auto-icon">
                                <span class="cell no-title" index="2" ></span>
                            </a>
                            <div class="collapse">
                                <div class="cell" index="1"></div>
                                <div class="cell" index="2"></div>
                            </div>
                        </td>
                        <td>{{ $item->ma }}</td>
                        <td>{{ $item->ten }}</td>
                        <td class="td-action">
                            <button class="btn btn-sm btn-icon btn-danger rounded-circle delete-btn"><i class="fas fa-trash"></i></button>
                            <a class="btn btn-sm btn-info btn-icon rounded-circle" 
                            href="{{ route('danhmuc.edit') }}?id={{$item->id}}"><i class="fas fa-pencil-alt"></i></a>
                        </td>

                    </tr>
                @endforeach
            @endslot
        </x-table>
    </div> 
@endsection