<div class="table-region">
    {{-- @isset($message) <div class="alert">{{}}</div> @endisset --}}
    <button class="btn btn-sm btn-danger rounded-circle p-2 delete-table-btn" data-href="{{ route('chucnang.delete') }}"><i
            class="fas fa-trash"></i></button>
    <x-table auto-index select id="table-main" >
        @slot('head')
            <th>Tên</th>
            <th>Đường dẫn</th>
        @endslot
        @slot('body')
            @foreach ($chucNangs as $cn)
                <tr data-id="{{ $cn->id }}">
                    <td>{{ $cn->ten }}</td>
                    <td>{{ $cn->url }}</td>
                </tr>
            @endforeach
        @endslot
    </x-table>
</div>
