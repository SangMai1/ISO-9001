@extends('layouts.master')
@section('title', 'Test')
@section('module', 'example')

@section('content')

    <div id="active-menu" href="/quan-li-xe/lich-sua-xe" active="khoiPhucTaiKhoan"></div>
    <x-input type="radio" name="name" :checked="true" />
    <x-input type="radio" name="name" :checked="true" />
    <x-input type="text" name="name" title="this is float" float />
    <x-input type="text" name="name" title="this is float" />

    <x-cards.tab color="danger" find-header>
        @slot('head')
            <x-cards.tab.head-item>Hi1</x-cards.tab.head-item>
            <x-cards.tab.head-item>Hi2</x-cards.tab.head-item>
            <x-cards.tab.head-item>Hi3</x-cards.tab.head-item>
            <x-cards.tab.head-item>Hi4</x-cards.tab.head-item>
            <x-cards.tab.head-item>Hi5</x-cards.tab.head-item>
        @endslot
        @slot('body')
            <div class="tab-pane">hi1</div>
            <div class="tab-pane">hi2</div>
            <div class="tab-pane">hi3</div>
            <div class="tab-pane">hi4</div>
            <div class="tab-pane">hi5</div>
        @endslot
    </x-cards.tab>
@endsection
