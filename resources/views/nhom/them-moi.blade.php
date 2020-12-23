@extends('layouts.master')

@section('title', 'Thêm mới nhóm')

@section('content')

    <!-- Alert message (start) -->
    @include('message')

    <form method="post" autocomplete="off" ajax-form>
        @csrf
        <x-input title="Mã nhóm" type="text" name="ma" float />
        <x-input title="Tên nhóm" type="text" name="ten" float />

        <x-table auto-index>
            @slot('head')
                <th><input type="checkbox" id="masterCheck" /></th>
                <th>Tên chức năng</th>
            @endslot
            @slot('body')

                @foreach ($idChucNang as $key => $value)
                    <tr data-id="{{ $key }}">
                        <td><input type="checkbox" value={{ $key }} name="chucnangs[]" /></td>
                        <td>{{ $value }}</td>


                    </tr>
                @endforeach

            @endslot
        </x-table>

        <button class="btn btn-info" type="submit">Thêm mới</button>
        <a class="btn btn-info" href="{{ route('nhom.list') }}" role="button">Danh sách</a>

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

        // check tất cả
        $(function() {

            // Header Master Checkbox Event
            $("#masterCheck").on("click", function() {
                if ($("input:checkbox").prop("checked")) {
                    $("input:checkbox[name='chucnangs[]']").prop("checked", true);
                } else {
                    $("input:checkbox[name='chucnangs[]']").prop("checked", false);
                }
            });

            // Check event on each table row checkbox
            $("input:checkbox[name='chucnangs[]']").on("change", function() {
                var total_check_boxes = $("input:checkbox[name='chucnangs[]']").length;
                var total_checked_boxes = $("input:checkbox[name='chucnangs[]']:checked").length;

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
