@extends('layouts.master')


@section('content')
@extends('layouts.master')
@section('title', '')
@section('pageName', '')
@section('module', '')

@section('content')

@endsection

    <form method="post" action="">
      @csrf
      <div class="form-group">
        <label>Tên :</label>
        <input class="form-control" type="text" name="textfield" placehorder=" Nhập tên" /><br>
      </div>

      <div class="form-group">
        <label>Số điện thoại :</label>
        <input class="form-control" type="number" name="numberfield" placehorder=" Nhập số điện thoại" /><br>
      </div>
    
      <div class="form-group">
                <label>Email:</label>
                <input class="form-control" type="email" name="emailfield" placehorder=" Nhập email" /><br>
            </div>

      <div class="form-group">
                <label>Password field:</label>
                <input class="form-control" type="password" name="passwordfield" /><br>
            </div>

      <div class="form-group">
            <label>Select option name:</label>
                <select  class="form-control" name="foreignkey_name" >
                  
                    <option value="0">1</option>
                    <option value="0">2</option>
                    <option value="0">3</option>
                    <option value="0">4</option>
                   
                </select>
                
         </div>
      <div class="form-group">
        <label>Date field :</label>
        <input class="form-control" type="date" name="datefield" /><br>
      </div>

      <div class="form-group">
                <label>Radio field:</label>
                <div class="form-check form-check-inline">
                <input type="radio" class="form-check-input" name="gender">
                   
                    <label class="form-check-label">Radio 1</label>
                </div>
                <div class="form-check form-check-inline">
                <input type="radio" class="form-check-input" name="gender">
                  
                    <label class="form-check-label">Radio 2</label>
                </div>
     </div>

      <input class="btn btn-primary" type="submit" value="Thêm" />
            <a class="btn btn-primary" href="" role="button">Danh sách</a>
  </div>
</form>
@endsection