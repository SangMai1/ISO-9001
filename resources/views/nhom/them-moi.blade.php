@extends('layouts.master')

@section('title', 'Thêm mới nhóm')

@section('content')
    <div id="active-menu" href="{{ route('nhom.create') }}"></div>
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

            const id = $(input).closest('tr').data('id');
            input.value = id;

            // var ID = [];
            // $("tr").each(function() {
            //     // input.setAttribute('value', $(this).data("data-id"));
            //     // ID.push($(this).attr("data-id"))
            //     input.setAttribute('value',$(this).attr("data-id"));
            // })

            // console.log(ID);

            console.log(input);
            // console.log($('tr').data("data-id"));
        }

    </script>
@endsection
