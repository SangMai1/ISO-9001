@extends('layouts.master')

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
        <th><a href="/" class="btn btn-primary">Thêm mới</a></th>
    <table class="table table-bordered"><br><br>
        
        <thead>
            <tr>
                <th>Tên</th>
                <th>SĐT</th>
                <th>Email</th>
                <th>Select</th>
                <th>Radio</th>
                

            </tr>
        </thead>
        <tbody>
            
                <tr>
                    <td>A</td>
                    <td>0938999222</td>
                    <td>a@gmail.com</td>
                    <td>3</td>
                    <td>Radio 1</td>
                   
                    <td>
                        <a class="btn btn-primary btn-sm"></span>Sửa</a>
                         <a class="btn btn-danger btn-sm" >Xoá</a>
                    </td>
                </tr>
                <tr>
                    <td>A</td>
                    <td>0938999222</td>
                    <td>a@gmail.com</td>
                    <td>3</td>
                    <td>Radio 1</td>
                   
                    <td>
                        <a class="btn btn-primary btn-sm" >Sửa</a>
                         <a class="btn btn-danger btn-sm" >Xoá</a>
                    </td>
                </tr>
                <tr>
                    <td>A</td>
                    <td>0938999222</td>
                    <td>a@gmail.com</td>
                    <td>3</td>
                    <td>Radio 1</td>
                   
                    <td>
                        <a class="btn btn-primary btn-sm" >Sửa</a>
                         <a class="btn btn-danger btn-sm" >Xoá</a>
                    </td>
                </tr>
                <tr>
                    <td>A</td>
                    <td>0938999222</td>
                    <td>a@gmail.com</td>
                    <td>3</td>
                    <td>Radio 1</td>
                   
                    <td>
                        <a class="btn btn-primary btn-sm" >Sửa</a>
                         <a class="btn btn-danger btn-sm" >Xoá</a>
                    </td>
                </tr>
                <tr>
                    <td>A</td>
                    <td>0938999222</td>
                    <td>a@gmail.com</td>
                    <td>3</td>
                    <td>Radio 1</td>
                   
                    <td>
                        <a class="btn btn-primary btn-sm" >Sửa</a>
                         <a class="btn btn-danger btn-sm" >Xoá</a>
                    </td>
                </tr>
                <tr>
                    <td>A</td>
                    <td>0938999222</td>
                    <td>a@gmail.com</td>
                    <td>3</td>
                    <td>Radio 1</td>
                   
                    <td>
                        <a class="btn btn-primary btn-sm" >Sửa</a>
                         <a class="btn btn-danger btn-sm" >Xoá</a>
                    </td>
                </tr>
           
        </tbody>
    </table>
</div>
</body>

</html>
@endsection