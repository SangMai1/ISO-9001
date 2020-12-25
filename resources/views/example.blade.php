@extends('layouts.master')
@section('title', 'Test')
@section('module', 'example')

@section('content')
    <form>
        <input type="checkbox" id="cb1">
        <input type="text" id="t1"> 
        <select class="selectpicker" data-style="btn btn-danger btn-round w-100" title="Single Select">
            <option disabled selected>Single Option</option>
            @php
                $collection = [
                    ['name'=>12, 'value'=>14],
                    ['name'=>12, 'value'=>14],
                    ['name'=>12, 'value'=>14],
                    ['name'=>12, 'value'=>14],
                    ['name'=>12, 'value'=>14],
                    ['name'=>12, 'value'=>14],
                    ['name'=>12, 'value'=>14],
                    ['name'=>12, 'value'=>14],
                    ['name'=>12, 'value'=>14],
                    ['name'=>12, 'value'=>14],
                    ['name'=>12, 'value'=>14],
                    ['name'=>12, 'value'=>14],
                    ['name'=>12, 'value'=>14],
                    ['name'=>12, 'value'=>14],
                    ['name'=>12, 'value'=>14],
                    ['name'=>12, 'value'=>14],
                    ['name'=>12, 'value'=>14],
                    ['name'=>12, 'value'=>14],
                    ['name'=>12, 'value'=>14],
                    ['name'=>12, 'value'=>14],
                    ['name'=>12, 'value'=>14],
                    ['name'=>12, 'value'=>14],
                    ['name'=>12, 'value'=>14],
                    ['name'=>12, 'value'=>14],
                    ['name'=>12, 'value'=>14],
                    ['name'=>12, 'value'=>14],
                    ['name'=>12, 'value'=>14],
                    ['name'=>12, 'value'=>14],
                    ['name'=>12, 'value'=>14],
                    ['name'=>12, 'value'=>14],
                    ['name'=>12, 'value'=>14],
                    ['name'=>12, 'value'=>14],
                    ['name'=>12, 'value'=>14],
                    ['name'=>12, 'value'=>14],
                    ['name'=>12, 'value'=>14],
                    ['name'=>12, 'value'=>14],
                ]
            @endphp
            @foreach ($collection as $item)
                <option value="{{ $item['value'] }}">{{ $item['name'] }}</option>
            @endforeach
        </select>
        <div></div>
    </form>
@endsection
