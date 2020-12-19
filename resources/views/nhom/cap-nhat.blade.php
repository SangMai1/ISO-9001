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
            @slot('title') Cập nhật nhóm @endslot
            @slot('body')

                <form method="post" action="{{ route('nhom.update') }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{ $nhoms['id'] }}" />
                    <div class="form-group">
                        <x-input title="Mã" type="text" name="ma" value="{{ old('ma', $nhoms->ma) }}" float />

                        @if ($errors->has('ma'))
                            <span class="errormsg">{{ $errors->first('ma') }}</span>
                        @endif

                    </div>

                    <div class="form-group">
                        <x-input title="Tên" type="text" name="ten" value="{{ old('ten', $nhoms->ten) }}" float />

                        @if ($errors->has('ten'))
                            <span class="errormsg">{{ $errors->first('ten') }}</span>
                        @endif

                    </div>

                    <div class="form-group">
                        {{-- <x-card>
                            @slot('body')

                                <x-table auto-index select>
                                    @slot('head')
                                        <th>Tên chức năng</th>
                                    @endslot
                                    @slot('body')
                                        @foreach ($idChucNang as $key => $value)
                                            <tr>
                                                <td>{{ $value }}</td>
                                            </tr>
                                        @endforeach
                                    @endslot
                                </x-table>

                            @endslot
                        </x-card> --}}
                        <label class="control-label col-md-3 col-sm-3 col-xs-12"
                            for="ten">Chức năng <span class="required"></span></label>
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
                                                    <td>
                                                            <input type="checkbox" value= {{ $key }} name="chucnangids[]" checked="{{  $key ? 'checked' : ''}}"
                                                            class="chucnangids" />
                                                        </td>
                                                    
                                                    <td>{{ $value }}</td>
                                                </tr>
                                         
                                            
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <input class="btn btn-sm btn-primary" type="submit" value="Cập nhật" />


                </form>

            @endslot
        </x-card>

    </div>

@endsection
