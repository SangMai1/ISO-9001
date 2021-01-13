@extends('layouts.master')
@section('title', 'Trang chủ')

@section('content')
    <form action="/noti">
        <x-input title="message" type="text" name="message" float />
        <select title="Người dùng" name="userid" autocomplete>
            @foreach ($users as $u)
                <option  value="{{ $u->id }}">{{ $u->username }}</option>
            @endforeach
        </select>
        <button class="btn btn-primary" type="submit">Gửi</button>
    </form>
    <script>
        $('#combobox').autoCompleteSelect()
    </script>
@endsection
