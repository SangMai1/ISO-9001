@extends('layouts.master')
@section('title', 'Cập nhật User')


@section('content')

    <!-- Alert message (start) -->
    @include('message');
    <!-- Alert message (end) -->

    <form method="post" action="{{ route('user.update') }}" autocomplete="off" ajax-form>
        @csrf
        <input type="hidden" name="id" value="{{ $users['id'] }}" />

        <x-input title="Tên tài khoản" type="text" name="username" value="{{ old('username', $users->username) }}" float />

        <x-input title="Email" type="email" name="email" value="{{ old('email', $users->email) }}" float />

        <x-input title="Mật khẩu" type="password" name="password" value="{{ old('password', $users->password) }}" float />  
          <div class="form-group">
            <label>Tên nhân viên </label>
            <select title="" class="form-control" name="nhanvienid">
              @foreach($idNhanVien as $key => $value)
                <option value="{{$key}}" {{$key == $users['nhanvienid'] ? 'selected':''}}>{{$value}}</option>
              @endforeach
            </select>
          </div>

        <input class="btn btn-sm btn-info" type="submit" value="Cập nhật" />


    </form>

    <script>
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
        });
      </script>
@endsection