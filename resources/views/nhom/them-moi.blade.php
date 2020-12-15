@extends('layouts.master')

@section('title', 'Quản lý nhóm')
@section('pageName', 'Thêm mới nhóm')

@section('content')

<div class="container">
    <!-- Alert message (start) -->
  @if(Session::has('message'))
  <div class="alert {{ Session::get('alert-class') }}">
    {{ Session::get('message') }}
  </div>
  @endif
  <!-- Alert message (end) -->

  <form method="post" action="{{ url('/nhom/them-moi') }}" id="myModal">


    {{csrf_field()}}
    

    <div class="form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ma">Mã <span class="required"></span></label>
      <div class="col-md-6 col-sm-6 col-xs-12">
        <input id="ma" class="form-control col-md-12 col-xs-12" name="ma" placeholder="Enter subject ten" required="required" type="text">

        @if ($errors->has('ma'))
        <span class="errormsg">{{ $errors->first('ma') }}</span>
        @endif
      </div>
    </div>
  
    <div class="form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ten">Tên <span class="required"></span></label>
      <div class="col-md-6 col-sm-6 col-xs-12">
        <input id="ten" class="form-control col-md-12 col-xs-12" name="ten" placeholder="Enter subject url" required="required" type="text">

        @if ($errors->has('ten'))
        <span class="errormsg">{{ $errors->first('ten') }}</span>
        @endif
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="chucnang">Chức năng <span class="required"></span></label>
      <div class="col-md-6 col-sm-6 col-xs-12">
        <table class="table table-bordered">
							<thead>
								<tr>
									<th>Select</th>
									<th>Tên chức năng</th>
								</tr>
							</thead>
							<tbody class="view-per">
                @foreach($idChucNang as $key => $value)
                  <tr>
                    <td><input type="checkbox" value={{$key}} name="chucnangs[]"/></td>
                    <td>{{$value}}</td>
                  </tr>
                @endforeach
							</tbody>
						</table>
      </div>
    </div>
    <input class="btn btn-primary" type="submit" value="Thêm" />
          <a class="btn btn-primary" href="/nhom/danh-sach" role="button">Danh sách</a>
  </div>
  </form>

</div>
@endsection