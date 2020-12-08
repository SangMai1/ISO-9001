@extends('layouts.app')

@section('content')


<!DOCTYPE html>
<html lang="en">

<head>
    <title>list </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
<div class="container">
    <?php
    ?>
     <h2>list</h2><br>
     <th><a href="/">Thêm</a></th>
    <table class="table table-bordered"><br><br>
       
        <thead>
            <tr>
                <th>STT</th>
                <th>select</th>
                <th>radio</th>
                

            </tr>
        </thead>
        <tbody>
            <?php
            $stt = 0;
            foreach ($table as $value) : $stt++
            ?>
                <tr>
                    <td>{{$stt}}</td>
                    <td>{{ $value['']}}</td>
                    <td>{{ $value['']}}</td>
                    <td><?php echo \App\model_phongbans::find($value['id_phongban'])->tenphongban ?></td>
                    <td><?php if (isset($value['radio']) && $value['radio']=="0") ?>Radio 1
                        <?php if (isset($value['radio']) && $value['radio']=="1") ?>Radio 2
                    </td>
                    <td>
                        <a class="btn btn-primary btn-sm" href="sua_phieuthuesach/{{$value['id']}}">Sửa</a>
                         <a class="btn btn-danger btn-sm" href="xoa_phieuthuesach/{{$value['id']}}">Xoá</a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>
</body>

</html>
@endsection