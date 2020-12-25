@extends('layouts.master')

@section('title', 'Thêm mới User')

@section('content')

    <!-- Alert message (start) -->
    @include('message')

    <form method="post" autocomplete="off" ajax-form>
        @csrf
        <x-input title="Tên tài khoản" type="text" name="username" float />
        <x-input title="Email" type="email" name="email" float />
        <x-input title="password" type="password" name="password" float />
        <div class="form-group">
          <label>Tên nhân viên </label>
          <select title="" class="form-control" name="nhanvienid">
            @foreach($idNhanVien as $key => $value)
              <option value="{{$key}}">{{$value}}</option>
            @endforeach
          </select>
        </div>

        <button class="btn btn-info" type="submit">Thêm mới</button>
        <a class="btn btn-info" href="{{ route('user.list') }}" role="button">Danh sách</a>

    </form>


    <script>
        $(() => {
            $('form[ajax-form]').validateCustom({
                rules: {
                    username: {
                        required: true,
                        minlength: 3
                    },
                    email: {
                        required: true,
                        minlength: 8
                    },
                    password: {
                        required: true,
                        minlength: 6
                    }
                }
            })
        })

        function setName(input) {
            input.setAttribute('ten', 'nhanviens[]')
        }

    </script>
@endsection

