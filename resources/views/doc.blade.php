@extends('layouts.master')
@section('title', 'Hướng dẫn layout')
@section('module', 'doc')

@section('content')
    <link href="/css/doc.css" rel="stylesheet">
    <script>
        const swalc = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success btn-sm',
                cancelButton: 'btn btn-danger btn-sm',
                content: 'sweet-content',
                popup: 'sweet-content',
            },
        })

        var encodedStr = (rawStr) => rawStr.replace(/[\u00A0-\u9999<>\&]/g, (i) => '&#' + i.charCodeAt(0) + ';');

        function renderCode(code, lang = 'html') {
            const current = document.currentScript
            window.ac = $(current)
            window.acs = encodedStr(code)
            $(current).parent().append($(`<pre><code class="${lang}">${encodedStr(code)}</code></pre><br>`))
        }

        function renderView(config = {}) {
            const current = document.currentScript
            $(() => {
                const view = $(current).next().addClass('d-none')
                console.log('render-view')

                function action() {
                    view.removeClass('d-none')
                    action = function() {
                        console.log(view[0])
                        swalc.fire({
                            ...config,
                            ...{
                                html: view[0],
                                width: 600,
                                height: '100%',
                                showConfirmButton: false,
                                showCloseButton: true,
                                allowOutsideClick: false,
                                closeOnConfirm: false,
                            }
                        })
                    }
                    action()
                }
                $(current).prev().click(() => action())
            })
        }

    </script>

    <x-card>
        @slot('title') Layout @endslot
        @slot('body')
            <div class="row">
                <div class="col-12">
                    <x-input title="Search" type="text" id="search-doc" float />
                </div>
                <div class="col-12">
                    <button class="btn btn-sm btn-primary btn-sm">Input Component</button>
                    <script>
                        renderView()

                    </script>
                    <div class="container">
                        <x-card>
                            @slot('title') Input checkbox @endslot
                            @slot('subTitle') @inputComponent @endslot
                            @slot('body')
                                <p>Code input với float:</p>
                                <x-input type="text" title="Đây là input với float" float />
                                <script>
                                    renderCode(`${'<'}x-input type="text" title="Đây là input với float" float/> `)

                                </script>

                                <p>Code input với float:</p>
                                <x-input type="text" title="Đây là input với không float"></x-input>
                                <script>
                                    renderCode(`${'<'}x-input type="text" title="Đây là input với không float"></${'x-input'}>`)

                                </script>

                                <p>Code input checkbox, radio:</p>
                                <x-input title="Đây là checkbox" type="checkbox" float />
                                <x-input title="Đây là radio 1" type="radio" float name="group" />
                                <x-input title="Đây là radio 2" type="radio" float name="group" />
                                <script>
                                    renderCode(
                                        `${'<'}x-input title="Đây là checkbox" type="checkbox" float />\n` +
                                        `${'<'}x-input title="Đây là radio 1" type="radio" float name="group"/>\n` +
                                        `${'<'}x-input title="Đây là radio 2" type="radio" float name="group" />\n`
                                    )

                                </script>

                                <p>Code sai với float:</p>
                                <x-input type="date" title="Không nên dùng float tại đây" float />
                                <x-input type="date" title="Không dùng float" />
                                <script>
                                    renderCode(
                                        `${'<'}x-input type="date" title="Không nên dùng float tại đây" /> \n` +
                                        `${'<'}x-input type="date" title="Không dùng float"/>`
                                    )

                                </script>

                                <x-input type="email" title="Email lỗi" value="123@gmail.com" error="Email không hơp lệ" float />

                                <div class="attr">
                                    <span name="float"> Dùng cho input nhập như text, number</span>
                                    <span name="title">label của mô tả input</span>
                                    <span name="error">Hiển thị lỗi cho input ( sẽ mất sau lần thay đổi dữ liệu trong input đầu tiên
                                        )</span>
                                    <span> - ( các thuộc tính khác sẽ được truyền vào trong input tag khi render ra )</span>
                                </div>
                            @endslot
                        </x-card>
                    </div>
                </div>
                <div class="col-12">
                    <button class="btn btn-sm btn-primary btn-sm">JQuery Validation Custom</button>
                    <script>
                        renderView()

                    </script>
                    <div class="container">
                        <x-card>
                            @slot('title') JQuery Validation Custom @endslot
                            @slot('subTitle') Validation trên trình duyệt @endslot
                            @slot('body')
                                <x-card>
                                    @slot('subTitle') Ví dụ @endslot
                                    @slot('body')
                                        <form id="form-ex" method="post" action="">
                                            <x-input title="Gõ vô là hết lỗi server / gõ 2 kí tự để hiện lỗi validation" type="text"
                                                name="first" error="Lỗi từ server nè!" float />
                                            <x-input title="Bắt buộc nhâp cái ni" type="text" name="second" float />
                                            <x-input title="Check vô là hết hiện lỗi server" type="checkbox" error="Lỗi từ server nè!"
                                                name="cb" class="ccbs" />
                                            <input type="submit" class="btn btn-success" value="Submit" />
                                        </form>
                                    @endslot
                                </x-card>
                                <br>
                                <p>- Code Blade</p>
                                <script>
                                    renderCode(
                                        `<form id=\"form-ex\" method=\"post\" action=\"\">\r\n    <x-input title=\"G\u00F5 v\u00F4 l\u00E0 h\u1EBFt l\u1ED7i server \/ g\u00F5 2 k\u00ED t\u1EF1 \u0111\u1EC3 hi\u1EC7n l\u1ED7i validation\" type=\"text\" name=\"first\" error=\"L\u1ED7i t\u1EEB server n\u00E8!\" float \/>\r\n    <x-input title=\"B\u1EAFt bu\u1ED9c nh\u00E2p c\u00E1i ni\" type=\"text\" name=\"second\" float \/>\r\n    <x-input title=\"Check v\u00F4 l\u00E0 h\u1EBFt hi\u1EC7n l\u1ED7i server\" type=\"checkbox\" error=\"L\u1ED7i t\u1EEB server n\u00E8!\"  name=\"cb\" \/>\r\n    <input type=\"submit\" class=\"btn btn-success\" value=\"Submit\" \/>\r\n<\/form>`
                                    )

                                </script>
                                <p>- Code trong module Script (validateCustom là hàm được tùy chỉnh để phù hơp với layout)</p>
                                <script>
                                    renderCode(
                                        `$(function () {\r\n    $('#form-ex').validateCustom({\r\n        rules: {\r\n            first: {\r\n                required: true,\r\n                minlength: 5\r\n            },\r\n            second: {\r\n                required: true\r\n            },\r\n            cb: {\r\n                required: true\r\n            }\r\n        }\r\n    });\r\n});`,
                                        'javascript')

                                </script>

                                <div class="attr">
                                    <span>Tham khảo thêm config tại <a
                                            href="https://viblo.asia/p/tim-hieu-ve-jquery-validation-phan-1-E375zEqRlGW">Tìm hiểu về
                                            Jquery Validation - viblo.asia</a></span>
                                </div>
                            @endslot
                        </x-card>
                    </div>
                </div>
                <div class="col-12">
                    <button class="btn btn-sm btn-primary btn-sm">Table Component</button>
                    <script>
                        renderView()

                    </script>
                    <div class="container">
                        <x-card>
                            @slot('title') Table Component (Chưa hoàn thiện) @endslot
                            @slot('subTitle') @tableComponent @endslot
                            @slot('body')
                                <x-card>
                                    @slot('subTitle') Table @endslot
                                    @slot('body')
                                        <button class="btn btn-primary" id="table-component-get-list-btn">Lấy danh sách record đã chọn
                                            tại đây</button>
                                        {{-- dữ liệu mẫu --}}
                                        @php $demoCollection = [
                                            ['id'=> 2, 'name' => 'Hoang', 'age'=>14],
                                            ['id'=> 3, 'name' => 'Nhi', 'age'=>15],
                                            ['id'=> 5 ,'name' =>'Dung', 'age'=>16]
                                        ] @endphp

                                        {{-- Tự động thêm(auto-index) index và select(select) --}}
                                        <x-table auto-index select id="table-component-table">
                                            @slot('head')
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Age</th>
                                            @endslot
                                            @slot('body')
                                                @foreach ($demoCollection as $item)
                                                    <tr data-id="{{ $item['id'] }}">
                                                        <td>{{ $item['id'] }}</td>
                                                        <td>{{ $item['name'] }}</td>
                                                        <td>{{ $item['age'] }}</td>
                                                    </tr>
                                                @endforeach
                                            @endslot
                                        </x-table>
                                    @endslot
                                </x-card>
                                <br>

                                <p>- Code Blade Cho view</p>
                                <script>
                                    renderCode(`<button class=\"btn btn-primary\" id=\"table-component-get-list-btn\">Lấy danh sách record đã chọn tại đây</button>\n${'{'}{-- dữ liệu mẫu --${'}'}}\n${'@'}php $demoCollection = [\n    ['id'=> 2, 'name' => 'Hoang', 'age'=>14],\n    ['id'=> 3, 'name' => 'Nhi', 'age'=>15],\n    ['id'=> 5 ,'name' =>'Dung', 'age'=>16]\n] ${'@'}endphp\n\n${'{'}{-- Tự động thêm(auto-index) index và select(select) --${'}'}}\n${'<'}x-table auto-index select id=\"table-component-table\">\n    ${'@'}slot('head')\n        <th>ID</th>\n        <th>Name</th>\n        <th>Age</th>\n    ${'@'}endslot\n    ${'@'}slot('body')\n        ${'@'}foreach ($demoCollection as $item)\n            <tr data-id=\"${'{'}{ $item['id'] ${'}'}}\">\n                <td>${'{'}{ $item['id'] ${'}'}}</td>\n                <td>${'{'}{ $item['name'] ${'}'}}</td>\n                <td>${'{'}{ $item['age'] ${'}'}}</td>\n            </tr>\n        ${'@'}endforeach\n    ${'@'}endslot\n${'<'}/x-table>`, 'html')
                                </script>

                                <p>- Code trong module</p>
                                <script>
                                    renderCode(`const getListBtn = $('#table-component-get-list-btn')\nconst table = $('#table-component-table')\ngetListBtn.on('click', function () {\n    const result = []\n    // Lấy ra DOM \"tr\" được chọn trong table (source trong file /resources/public/js/master-layout.ts => find \"_eachSelected\")\n    table[0]._eachSelected(function (tr) {\n        // Lấy data từ DOM tr -> data-id -> xem thêm về JQuery.fn.data -> https://viblo.asia/p/su-khac-nhau-giua-attr-va-data-trong-jquery-bJzKmzzEZ9N\n        result.push($(tr).data('id'))\n    })\n\n    alert(\`id của các table được chọn: \${JSON.stringify(result)}\`);\n})`, 'js')
                                </script>

                                <div class="attr">
                                    <span name="auto-index">View sẽ tự động render Cột chỉ mục khi trang tải xong (Ngoài ra còn có
                                        thể dùng JQuery.fn._autoIndexTable())</span>
                                    <span name="select">View sẽ tự động render Cột lựa chọn row khi được tải (Ngoài ra còn có thể
                                        dùng JQuery.fn._autoSelectMode())</span>
                                </div>
                            @endslot
                        </x-card>
                    </div>
                </div>
            </div>

        @endslot

    </x-card>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/highlightjs-themes@1.0.0/atelier-cave.light.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/10.4.1/highlight.min.js"></script>
    <script>
        hljs.initHighlightingOnLoad();

    </script>
@endsection
