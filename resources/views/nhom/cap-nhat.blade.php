@extends('layouts.master')
@section('title', 'Cập nhật nhóm')


@section('content')


    <form method="post" action="{{ route('nhom.update') }}" ajax-form>
        @csrf
        <input type="hidden" name="id" value="{{ $nhoms->id}}" />

        <x-input title="Mã" type="text" name="ma" value="{{ $nhoms->ma }}" float />

        <x-input title="Tên" type="text" name="ten" value="{{ $nhoms->ten }}" float />

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

        <input class="btn btn-sm btn-info" type="submit" value="Cập nhật" />


    </form>

    <script>
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
        });

        function setName(input) {
            input.setAttribute('name', 'chucnangids[]')
            const id = $(input).closest('tr').data('id');
            input.value = id;

            let a = [];
            let b = [];


            var els = document.getElementsByClassName('form-check-input');
            Array.prototype.forEach.call(els, function(el) {
                a.push(parseInt(el.value));
            });
            
            var sites = {!!json_encode($chucNangCheck -> toArray(), JSON_HEX_TAG) !!};
            sites.forEach(si => {
                b.push(si['chucnangid']);

            });

            var intersection = a.filter(element => b.includes(element));
            for (var i of intersection) {
                var lls = document.getElementsByClassName('form-check-input');
                Array.prototype.forEach.call(lls, function(el) {
                    if (el.value == i) {
                        el.setAttribute('checked', 'checked');

                    }
                });
            };
        }


    </script>
@endsection
