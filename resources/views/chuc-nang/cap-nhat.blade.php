{{-- @extends('layouts.master')

@section('title', 'Quản lý chức năng')
@section('pageName', 'Cập nhật chức năng')

@section('content')
  <div class="container">
    
        <!-- Alert message (start) -->
        @if(Session::has('message'))
        <div class="alert {{ Session::get('alert-class') }}">
          {{ Session::get('message') }}
        </div>
        @endif
        <!-- Alert message (end) -->

        <form method="post" action="{{ route('editChucNang')}}" id="myModalEdit">
          {{csrf_field()}}
          <input class="form-control" type="hidden" name="id" value="{{$chucnang['id']}}" /><br>
          <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ten">Tên <span class="required"></span></label>
        <div class="col-md-6 col-sm-6 col-xs-12">
          <input id="ten" class="form-control col-md-12 col-xs-12" name="ten" placeholder="Enter subject ten" required="required" type="text" value="{{old('name',$chucnang->ten)}}">

          @if ($errors->has('ten'))
          <span class="errormsg">{{ $errors->first('ten') }}</span>
          @endif
        </div>
      </div>
    
      <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Url <span class="required"></span></label>
        <div class="col-md-6 col-sm-6 col-xs-12">
          <input id="url" class="form-control col-md-12 col-xs-12" name="url" placeholder="Enter subject url" required="required" type="text" value="{{old('name',$chucnang->url)}}">

          @if ($errors->has('url'))
          <span class="errormsg">{{ $errors->first('url') }}</span>
          @endif
        </div>
      </div>
        
          <input class="btn btn-primary" type="submit" value="Cập nhật" />
        
      </div>
    </form>
  </div>
    
@endsection --}}