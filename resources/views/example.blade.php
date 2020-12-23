@extends('layouts.master')
@section('title', 'Test')
@section('module', 'example')

@section('content')
    {{-- <script src="/js/utils.js"></script> --}}
    <div id="active-menu" href="/quan-li-xe/lich-sua-xe" active="khoiPhucTaiKhoan"></div>
    <button id="main-btn">BTN</button>
    <script>
        function cloneMassive(node) {
            // Clone the node, don't clone the childNodes right now...
            var dupNode = node.cloneNode(false);
            var events = window.getEventListeners(node);

            for (var p in events) {
                // All events is in an array so iterate that array:
                events[p].forEach(function(ev) {
                    // {listener: Function, useCapture: Boolean}
                    dupNode.addEventListener(p, ev.listener, ev.useCapture);
                });
            }
            // Also do the same to all childNodes and append them.
            if (node.childNodes.length) {
                [].slice.call(node.childNodes).forEach(function(node) {
                    dupNode.appendChild(cloneMassive(node));
                });
            }

            return dupNode;
        }
        $(() => {

            const btn = document.querySelector('#main-btn')
            $(btn).on('click', function() {
                alert('from jquery')
            })
            btn.addEventListener('click', function() {
                alert('from dom')
            })
            document.body.appendChild(cloneMassive(btn))
        })

    </script>
@endsection
