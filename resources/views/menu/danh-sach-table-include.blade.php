<x-table auto-index select class="mobile" delete-href="{{ route('menu.delete') }}">
    @slot('head')
        <th class="th-mobile">Menu</th>
        <th>Tên</th>
        <th>Vị trí</th>
        <th>URL</th>
        <th>Cập nhật</th>
        <th>Icon</th>
        <th class="th-action"><i class="fas fa-cogs"></i></th>
    @endslot
    @slot('body')
        @foreach ($menus as $m)
            <tr data-id="{{ $m->id }}">
                <td class="td-mobile">
                    <a data-toggle="collapse" class="dropdown-toggle btn-info btn auto-icon">
                        <span class="cell" index="1"></span>
                    </a>
                    <div class="collapse">
                        <div class="cell" index="2"></div>
                        <div class="cell" index="3"></div>
                        <div class="cell" index="4"></div>
                        <div class="cell" index="5"></div>
                    </div>
                </td>
                <td>{{ $m->ten }}</td>
                <td>{{ $m->vitri }}</td>
                <td>{{ $m->url }}</td>
                <td>{{ $m->nguoisua }}</td>
                <td>{{ $m->icon }}</td>
                <td class="td-action">
                    <button class="btn btn-sm btn-danger btn-icon rounded-circle delete-btn"><i class="fas fa-trash"></i></button>
                    <a class="btn btn-sm btn-info btn-icon rounded-circle" href="{{ route('menu.edit') . '?id=' . $m->id }}"><i class="fas fa-pencil-alt"></i></a>
                </td>
            </tr>
        @endforeach
    @endslot
</x-table>
