<div class="table-region">
    @isset($message) <div class="alert">{{ $message }}</div> @endisset

    <x-table auto-index id="table-main" class="mobile" select delete-href="{{ route('chucnang.delete') }}">
        @slot('head')
            <th class="th-mobile">Chức năng</th>

            <th>ID</th> 
            {{-- field chính --}}
            <th>Tên</th> 
            {{-- field chính --}}
            <th>Đường dẫn</th> 
            {{-- field chính --}}

            <th class="th-action"><i class="fas fa-cogs"></i></th>
        @endslot
        @slot('body')
            @foreach ($chucNangs as $cn)
                <tr data-id="{{ $cn->id }}">

                    <td>{{ $cn->id }}</td>
                    <td>{{ $cn->ten }}</td>
                    <td>{{ $cn->url }}</td>

                    <td class="td-mobile">
                        <a data-toggle="collapse" class="dropdown-toggle btn-info btn">
                            <span class="cell mr-auto no-title" index="2"></span>
                        </a>
                        <div class="collapse">
                            <div class="cell" index="1"></div>
                            <div class="cell" index="2"></div>
                            <div class="cell" index="3"></div>
                        </div>
                    </td>
                    <td class="td-action">
                        <button class="btn btn-sm btn-icon btn-danger rounded-circle delete-btn"><i
                                class="fas fa-trash"></i></button>
                    </td>
                </tr>
            @endforeach
        @endslot
    </x-table>
</div>
