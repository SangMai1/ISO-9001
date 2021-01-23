<div class="table-region">
    @isset($message) <div class="alert">{{ $message }}</div> @endisset

    <x-table auto-index id="table-main" class="mobile" load-more="{{route('phongBan.list')}}"
        delete-href="{{ route('phongBan.delete') }}">
        @slot('head')
            <th class="th-mobile">Chức năng</th>
            <th>Mã phòng ban</th>
            <th>Tên phòng ban</th>
            <th>Trưởng phòng</th>
            <th class="th-action"><i class="fas fa-cogs"></i></th>
        @endslot
        @slot('body')
            @foreach ($phongBans as $pb)
                <tr data-id="{{ $pb->id }}">
                    <td class="td-mobile">
                        <a data-toggle="collapse" class="dropdown-toggle btn-info btn auto-icon px-3">
                            <span class="cell no-title" index="2"></span>
                        </a>
                        <div class="collapse">
                            <div class="cell" index="1"></div>
                            <div class="cell" index="2"></div>
                            <div class="cell" index="3"></div>
                            <div class="cell" index="4"></div>
                        </div>
                    </td>

                    <td>{{ $cn->ma }}</td>
                    <td>{{ $cn->ten }}</td>
                    <td><a href="{{ route('u.nhanvien.query', ['type' => 'info', 'id' => $cn->truongphong_nvid])}}">{{ $cn->truongphong_nvid }}</a></td>
                    <td><a href="{{ route('u.nhanvien.query', ['type' => 'info', 'id' => $cn->truongphong_nvid])}}">{{ $cn->truongphong_nvid }}</a></td>
                    <td><a href="{{ route('u.nhanvien.query', ['type' => 'info', 'id' => $cn->truongphong_nvid])}}">{{ $cn->truongphong_nvid }}</a></td>
                    <td class="td-action">
                        <button class="btn btn-sm btn-icon btn-danger rounded-circle delete-btn"><i class="fas fa-trash"></i></button>
                        <a class="btn btn-sm btn-info btn-icon rounded-circle" 
                            href="{{ route('phongBan.edit') }}?id={{$cn->id}}"><i class="fas fa-pencil-alt"></i></a>
                    </td>
                </tr>
            @endforeach
        @endslot
    </x-table>
</div>
