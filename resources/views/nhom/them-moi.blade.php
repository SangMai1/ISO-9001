@extends('layouts.master')

@section('title', '')
@section('pageName', '')

@section('content')

    <div class="container">
        <!-- Alert message (start) -->
        @if (Session::has('message'))
            <div class="alert {{ Session::get('alert-class') }}">
                {{ Session::get('message') }}
            </div>
        @endif
        <!-- Alert message (end) -->

        <x-card>
            @slot('title') Thêm mới nhóm @endslot
            @slot('body')

                <form method="post" action="{{ url('/nhom/them-moi') }}" id="myModal">


                    {{ csrf_field() }}


                    <div class="form-group">
                        <x-input title="Mã nhóm" type="text" name="ma" float />
                        @if ($errors->has('ma'))
                            <span class="errormsg">{{ $errors->first('ma') }}</span>
                        @endif

                    </div>

                    <div class="form-group">
                        <x-input title="Tên nhóm" type="text" name="ten" float />

                        @if ($errors->has('ten'))
                            <span class="errormsg">{{ $errors->first('ten') }}</span>
                        @endif

                    </div>
                    <div class="form-group">
                        <x-card>


                            @slot('body')
                                <x-table auto-index select>
                                    @slot('head')

                                        <th>Tên chức năng</th>
                                    @endslot
                                    @slot('body')

                                        @foreach ($idChucNang as $key => $value)
                                            <tr data-id="{{ $key }}">
                                                <td><input type="checkbox" value={{ $key }}
                                                        name="chucnangs[]" /></td> --}} 
                                                 <td>{{ $value }}</td> --}}
                                                

                                            </tr>
                                        @endforeach
                                        <script type="text/javascript">
                                                     var list, index;
                                                     list = document.getElementsByClassName("form-check-input");
                                                     for (index = 0; index < list.length; ++index) {
                                                         console.log("sang" + list[index]);
                                                         list[index].setAttribute('name', 'chucnangs[]');
                                                     }
                                                     let btnSend = document.querySelector('.form-check-input');
                                                    if (btnSend) {
                                                         btnSend.setAttribute('name', 'chucnangs[]');
                                                      
                                                    } 

                                                </script> 
                                    @endslot
                                </x-table>
                            @endslot
                        </x-card>
                        <label class="control-label col-md-3 col-sm-3 col-xs-12"
                            for="chucnang">Chức năng <span class="required"></span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Select</th>
                                        <th>Tên chức năng</th>
                                    </tr>
                                </thead>
                                <tbody class="view-per">
                                    @foreach ($idChucNang as $key => $value)
                                        <tr>
                                            <td><input type="checkbox" value={{ $key }} name="chucnangs[]" /></td>
                                            <td>{{ $value }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <input class="btn btn-sm btn-primary" type="submit" value="Thêm" />
                    <a class="btn btn-sm btn-primary" href="/nhom/danh-sach" role="button">Danh sách</a>

                </form>

            @endslot
        </x-card>


    </div>

@endsection
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js">
</script>
<script type="text/javascript">
    $(document).ready(function() {
        console.log('ssang');
        $('.form-check-input').attr('name', 'chucnangs[]');
    });

</script> --}}
