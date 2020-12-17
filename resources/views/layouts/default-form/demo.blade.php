@extends('layouts.master')
@section('title', '')
@section('pageName', '')

@section('content')

<div class="container">
    <h2>list</h2><br>
        <th><a href="/" class="btn btn-primary">Thêm mới</a></th>
    <table class="table table-bordered table-hover"><br><br>
        
        <thead>
            <tr>
                <th width="50px"><input type="checkbox" id="master"></th>
                <th>Tên</th>
                <th>SĐT</th>
                <th>Email</th>
                <th>Select</th>
                <th>Radio</th>
                

            </tr>
        </thead>
        <tbody>
            
                <tr>
                    <td><input type="checkbox"  ></td>
                    <td>A</td>
                    <td>0938999222</td>
                    <td>a@gmail.com</td>
                    <td>3</td>
                    <td>Radio 1</td>
                   
                    <td>
                        <a><i
                       class="fa fa-pencil-square-o mr-2" aria-hidden="true"></i></a>
                     <a><i class="fa fa-trash-alt" aria-hidden="true" ></i></a>
                    </td>
                </tr>
                <tr>
                    <td><input type="checkbox"  ></td>
                    <td>A</td>
                    <td>0938999222</td>
                    <td>a@gmail.com</td>
                    <td>3</td>
                    <td>Radio 1</td>
                   
                    <td>
                        <a><i
                       class="fa fa-pencil-square-o mr-2" aria-hidden="true"></i></a>
                     <a><i class="fa fa-trash-alt" aria-hidden="true" ></i></a>
                    </td>
                </tr>
                <tr>
                    <td><input type="checkbox"  ></td>
                    <td>A</td>
                    <td>0938999222</td>
                    <td>a@gmail.com</td>
                    <td>3</td>
                    <td>Radio 1</td>
                   
                    <td>
                        <a><i
                       class="fa fa-pencil-square-o mr-2" aria-hidden="true"></i></a>
                     <a><i class="fa fa-trash-alt" aria-hidden="true" ></i></a>
                    </td>
                </tr>
                <tr>
                    <td><input type="checkbox"  ></td>
                    <td>A</td>
                    <td>0938999222</td>
                    <td>a@gmail.com</td>
                    <td>3</td>
                    <td>Radio 1</td>
                   
                    <td>
                        <a><i
                       class="fa fa-pencil-square-o mr-2" aria-hidden="true"></i></a>
                     <a><i class="fa fa-trash-alt" aria-hidden="true" ></i></a>
                    </td>
                    <x-inputs.checkbox name="">
                        @slot('content') @endslot
                    </x-inputs.checkbox>
                    <x-inputs.input title="Email" type="text" name="name" error="cscs"></x-inputs.input>
                </tr>
                <tr>
                    <td><input type="checkbox"  ></td>
                    <td>A</td>
                    <td>0938999222</td>
                    <td>a@gmail.com</td>
                    <td>3</td>
                    <td>Radio 1</td>
                   
                    <td>
                        <a><i
                       class="fa fa-pencil-square-o mr-2" aria-hidden="true"></i></a>
                     <a><i class="fa fa-trash-alt" aria-hidden="true" ></i></a>
                    </td>
                </tr>
           
        </tbody>
    </table>
</div>
@endsection