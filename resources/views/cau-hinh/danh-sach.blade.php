@extends('layouts.master')
@section('title', 'Quản lý cấu hình')
@section('pageName', 'Danh sách cấu hình')
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
@section('content')
    @if (Session::get('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif
    @if (Session::get('fail'))
        <div class="alert alert-danger">
            {{ Session::get('fail') }}
        </div>
    @endif
    <br>
	
    <div class="row">

        <div class="col-md-6">
            <a class="btn btn-light" href="{{ url('/cau-hinh/da-xoa') }}" style="margin-bottom: 10px" title="Cấu hình đã xóa"> <i class="fas fa-recycle"></i></a>
            <input class="btn btn-success" type="submit" name="submit" value="Xóa tất cả"/>
        </div>
        <div class="col-md-4">
            <form action="{{ url('/cau-hinh/tim-kiem') }}" method="GET">
                <div class="input-group">
                    <input type="search" name="search" class="form-control">
                    <span class="input-group-prepend">
                        <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                    </span>
                </div>
            </form>
        </div>
        <div class="col-md-2 text-right">
            <a href="/cau-hinh/them-moi" style="margin-bottom: 10px" class="btn btn-primary">Thêm mới</a>
        </div>
    </div>
    <table class="table table-bordered "><br><br>
        <thead>
            <tr>
                <th><input type="checkbox" id="chkCheckAll"></th>
                <th>Stt</th>
                <th>Mã</th>
                <th>Tên</th>
                <th>Giá trị</th>
                <th>Người tạo</th>
                <th>Ngày tạo</th>
                <th>Người sửa</th>
                <th>Ngày sửa</th>
                <th>Action</th>
                


            </tr>
        </thead>
        <tbody>
            <?php
            $stt = 0;
            foreach ($cauhinh as $value):
            $stt++; ?>
            <tr id="sid{{ $value->id }}">
                <td><input type="checkbox" name="ids" class="checkBoxClass" value="{{ $value['id'] }}" /></td>
                <td>{{ $stt }}</td>
                <td>{{ $value['ma'] }}</td> 
                <td>{{ $value['ten'] }}</td>
                <td>{{ $value['giatri'] }}</td>
                <td>{{ $value['nguoitao'] }}</td>
                <td>{{ $value['ngaytao'] }}</td>
                <td>{{ $value['nguoisua'] }}</td>
                <td>{{ $value['ngaysua'] }}</td>
                <td>
                        <form action="{{ route('cauhinhs.destroy', $value->id) }}" method="POST">
                            <a href="{{ url('/cau-hinh/chinh-sua', $value->id) }}"  title="Chỉnh sửa" style="color: none; ">
                                <i class="fa fa-pencil-square-o text-success" aria-hidden="true" ></i></a>   
                               
                            
                            @csrf
                            @method('DELETE')
    
                            <button type="submit" title="Xóa" style="border: none; background-color:transparent;">
                                <i class="fa fa-trash-alt text-danger" aria-hidden="true"></i>
    
                            </button>
                        </form>
                    </td>
            </tr>
            <?php
            endforeach;
            ?>

        </tbody>

    </table>
    
   
</div>
    <div class="d-flex justify-content-center">{{ $cauhinh->onEachSide(1)->links() }}</div>
    <!-- small modal -->

    <script>
        
        $('.buttonDelete').on('click', function(event) {
          event.preventDefault();
          $('#myDelete').modal();
          $('#delRef').click(function() {
            $('#formDelete').submit();
          });
        });
        $(document).on('click', '#smallButton', function(event) {
            event.preventDefault();
            var href = $(this).attr('href');
            $.ajax({
                url: href,
                beforeSend: function() {
                    $('#loader').show();
                },
                // return the result
                success: function(result) {
                    $('#smallModal').modal("show");
                    $('#smallBody').html(result).show();
                },
                complete: function() {
                    $('#loader').hide();
                },
                // error: function(jqXHR, testStatus, error) {
                //     console.log(error);
                //     alert("Page " + href + " cannot open. Error:" + error);
                //     $('#loader').hide();
                // },
                timeout: 8000
            });
        });

    </script>

@endsection
