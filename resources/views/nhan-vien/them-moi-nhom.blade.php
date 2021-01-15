@extends('layouts.master')

@section('title', 'Phân quyền theo nhóm')

@section('content')
    <form method="post" autocomplete="off" ajax-form>
        @csrf
        <x-input title="Mã nhân viên" type="text" name="userid" value="{{$nhanVien->id}}" float />
        <x-table auto-index select="setName">
            @slot('head')
                <th>Tên nhóm</th>
            @endslot
            @slot('body')

                @foreach ($idNhom as $key => $value)
                    <tr data-id="{{ $key }}">
                        <td>{{ $value }}</td>

                    </tr>
                @endforeach

            @endslot
        </x-table>

        <button class="btn btn-info" type="submit">Thêm mới</button>

    </form>


    <script>
        $(() => {
            $('form[ajax-form]').validateCustom({
                rules: {
                    chucnangid: {
                        required: true,
                      
                    }
                }
            })
        })

        function setName(input) {
            input.setAttribute('name', 'nhoms[]')
            const id = $(input).closest('tr').data('id');
            input.value = id;
        }

    </script>
@endsection
