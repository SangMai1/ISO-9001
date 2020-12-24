@extends('layouts.master')

@section('title', 'Thêm mới nhóm')

@section('content')

    <!-- Alert message (start) -->
    @include('message')

    <form method="post" autocomplete="off" ajax-form>
        @csrf
        <x-input title="Mã nhóm" type="text" name="ma" float />
        <x-input title="Tên nhóm" type="text" name="ten" float />
        <x-table auto-index select="setName">
            @slot('head')
                <th>Tên chức năng</th>
            @endslot
            @slot('body')

                @foreach ($idChucNang as $key => $value)
                    <tr data-id="{{ $key }}">
                        <td>{{ $value }}</td>

                    </tr>
                @endforeach

            @endslot
        </x-table>

        <button class="btn btn-info" type="submit">Thêm mới</button>
        <a class="btn btn-info" href="{{ route('nhom.list') }}" role="button">Danh sách</a>

    </form>


    <script>
        $(() => {
            $('form[ajax-form]').validateCustom({
                rules: {
                    ma: {
                        required: true,
                        minlength: 1
                    },
                    ten: {
                        required: true,
                        minlength: 3
                    }
                }
            })
        })

        function setName(input) {
            input.setAttribute('name', 'chucnangs[]')
        }

    </script>
@endsection
