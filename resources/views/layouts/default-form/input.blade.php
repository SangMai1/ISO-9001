@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
  <title></title>
</head>

<body>
  <div class="container"><br><br>
    <form method="post" action="">
      @csrf
      <div class="form-group">
        <label>Text field :</label>
        <input class="form-control" type="text" name="textfield" /><br>
      </div>

      <div class="form-group">
        <label>Number field :</label>
        <input class="form-control" type="number" name="numberfield" /><br>
      </div>
    
      <div class="form-group">
                <label>Email field:</label>
                <input class="form-control" type="email" name="emailfield" /><br>
            </div>

      <div class="form-group">
                <label>Password field:</label>
                <input class="form-control" type="password" name="passwordfield" /><br>
            </div>

      <div class="form-group">
            <label>Select option name:</label>
                <select name="foreignkey_name">
                    @foreach($selectoption_name as $value)
                    <option value="{{$value['id']}}">{{$value['name']}}</option>
                    @endforeach
                </select>
                
         </div>
      <div class="form-group">
        <label>Date field :</label>
        <input class="form-control" type="date" name="datefield" /><br>
      </div>

      <div class="form-group">
                <label>Radio field:</label>
                <div class="form-check form-check-inline">
                <input type="radio" class="form-check-input" name="gender"
                    <?php if (isset($gender) && $gender=="0") echo "checked";?>
                    value="0">
                    <label class="form-check-label">Radio 1</label>
                </div>
                <div class="form-check form-check-inline">
                <input type="radio" class="form-check-input" name="gender"
                    <?php if (isset($gender) && $gender=="1") echo "checked";?>
                    value="1">
                    <label class="form-check-label">Radio 2</label>
                </div>
     </div>

      <input class="btn btn-primary" type="submit" value="Thêm" />
            <a class="btn btn-primary" href="" role="button">Danh sách</a>
  </div>
</body>
@endsection