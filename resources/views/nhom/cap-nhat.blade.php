@extends('layouts.master')
@section('title', 'Cập nhật nhóm')


@section('content')

    <!-- Alert message (start) -->
    @include('message');
    <!-- Alert message (end) -->

    <form method="post" action="{{ route('nhom.update') }}" autocomplete="off" ajax-form>
        @csrf
        <input type="hidden" name="id" value="{{ $nhoms['id'] }}" />

        <x-input title="Mã" type="text" name="ma" value="{{ old('ma', $nhoms->ma) }}" float />

        <x-input title="Tên" type="text" name="ten" value="{{ old('ten', $nhoms->ten) }}" float />

        <x-table auto-index>
            @slot('head')
                <th><input type="checkbox" id="masterCheck" /></th>
                <th>Tên chức năng</th>
            @endslot
            @slot('body')
                @foreach ($idChucNang as $key => $value)
                    <tr>
                        <td>
                            <input type="checkbox" value={{ $key }} name="chucnangids[]" class="chucnangids">
                        </td>
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


        let a = [];
        let b = [];


        var els = document.getElementsByClassName('chucnangids');
        Array.prototype.forEach.call(els, function(el) {
            a.push(parseInt(el.value));
        });

        var sites = {!!json_encode($chucNangCheck -> toArray(), JSON_HEX_TAG) !!};
        sites.forEach(si => {
            b.push(si['chucnangid']);

        });

        var intersection = a.filter(element => b.includes(element));
        for (var i of intersection) {
            var lls = document.getElementsByClassName('chucnangids');
            Array.prototype.forEach.call(lls, function(el) {
                if (el.value == i) {
                    el.setAttribute('checked', 'checked');

                }
            });
        };

        // check tất cả
        $(function() {

            // Header Master Checkbox Event
            $("#masterCheck").on("click", function() {
                if ($("input:checkbox").prop("checked")) {
                    $("input:checkbox[name='chucnangids[]']").prop("checked", true);
                } else {
                    $("input:checkbox[name='chucnangids[]']").prop("checked", false);
                }
            });

            // Check event on each table row checkbox
            $("input:checkbox[name='chucnangids[]']").on("change", function() {
                var total_check_boxes = $("input:checkbox[name='chucnangids[]']").length;
                var total_checked_boxes = $("input:checkbox[name='chucnangids[]']:checked").length;

                // If all checked manually then check master checkbox
                if (total_check_boxes === total_checked_boxes) {
                    $("#masterCheck").prop("checked", true);
                } else {
                    $("#masterCheck").prop("checked", false);
                }
            });
        });

    </script>
@endsection
