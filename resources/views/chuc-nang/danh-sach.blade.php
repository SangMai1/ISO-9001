@extends('layouts.master')
@section('title', '')
@section('pageName', '')

@section('content')
    <div class="container">


        <!-- Alert message (start) -->
        @if (Session::has('message'))
            <div class="alert {{ Session::get('alert-class') }}">
                {{ Session::get('message') }}
            </div>
        @endif
        <!-- Alert message (end) -->
        <x-card>
            @slot('title') Danh sách chức năng @endslot
            @slot('body')

                {{-- Thêm mới chức năng --}}
                <a href="/chuc-nang/them-moi" class="btn btn-sm btn-primary"><i class="fas fa-plus-circle"></i></a>

                {{-- Xóa chức năng --}}
                <button class="btn btn-sm btn-primary buttonDelete"><i class="fas fa-trash-alt"></i></button>

                {{-- Search chức năng --}}
                <form action="{{ route('chucnang.search') }}" method="GET">
                    <div class="form-group">

                        <x-input title="Tìm kiếm" type="text" name="search" float />
                        <button type="submit" class="btn btn-sm btn-primary">Tìm kiếm</button>

                    </div>
                </form>
                <x-table auto-index select>
                    @slot('head')
                        <th>Tên</th>
                        <th>URL</th>
                    @endslot
                    @slot('body')
                        @foreach ($chucNangs as $cn)
                            <tr data-id="{{ $cn->id }}" name="idss[]">
                                <td><a href="{{ route('chucnang.edit', [$cn->id]) }}">{{ $cn->ten }}</a></td>
                                <td>{{ $cn->url }}</td>
                            </tr>
                        @endforeach
                    @endslot
                </x-table>
            @endslot
        </x-card>






        <!-- The Modal Delete -->
        <div class="modal" tabindex="-1" role="dialog" id="myDelete">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div id="delete-body">
                        <h4>Bạn có muốn xóa không?</h4>


                    </div>
                    <div class="modal-footer">
                        <button type="button" id="delRef" class="btn btn-primary">Xác nhận</button>
                        <button type="button" class="btn btn-primary thoat" data-dismiss="modal">Thoát</button>
                    </div>
                </div>
            </div>
        </div>





    </div>


@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.buttonDelete').on('click', function(event) {
            event.preventDefault();
            $('#myDelete').modal();
            $('#delRef').click(function() {
                $('#formDelete').submit();
            });

        });

    });

</script>
