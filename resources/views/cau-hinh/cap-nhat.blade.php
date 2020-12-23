@extends('layouts.master')
@section('title', 'Cập nhật cấu hình')


@section('content')

    <!-- Alert message (start) -->
    @include('message');
    <!-- Alert message (end) -->

    <form method="post" action="{{ route('cauhinh.update') }}" autocomplete="off" ajax-form>
        @csrf
        <input type="hidden" name="id" value="{{ $cauhinh['id'] }}" />

        <x-input title="Mã" type="text" name="ma" value="{{ old('ma', $cauhinh->ma) }}" float />

        <x-input title="Tên" type="text" name="ten" value="{{ old('ten', $cauhinh->ten) }}" float />

        <x-input title="Giá trị" type="text" name="giatri" value="{{ old('giatri', $cauhinh->giatri) }}" float />

        <input class="btn btn-sm btn-info" type="submit" value="Cập nhật" />


    </form>

    <script>
        $('form[ajax-form]').validateCustom({
          rules: {
                ma: {
                    required: true,
                    minlength: 5
                },
                ten: {
                    required: true,
                    minlength: 6
                },
                giatri: {
                    required: true,
                    minlength: 3
                },
            }
        });
      </script>
@endsection