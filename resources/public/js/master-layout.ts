//@ts-nocheck
// @ts-ignore
const token = document.querySelector('.csrf-token > input').value;
var Toast = Swal.mixin({
    toast: true,
    position: 'top-right',
    showConfirmButton: false,
    showCloseButton: true,
    timer: undefined,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', window.Swal.stopTimer)
        toast.addEventListener('mouseleave', window.Swal.resumeTimer)
    }
})
var showLoading = function (message = "Chờ xí ...") { Toast.fire({ title: message, showCloseButton: false, didOpen: () => window.Swal.showLoading() }) };
var getMessage = (html) => {
    try {
        let result = $('.alert-message', $(html)).text()
        eval(`result = ${result}`)
        return result
    } catch (error) {
        
    }
}; 

(function () {
    addJqueryValidationCustom()
    addJqueryTableAutoIndex()
    addSelectModeTable()
    addHTMLTableElementPrototype()
    addPrototypeFormData()
    fixTooltip()
    fixMaterial()

    $.ajaxSetup({
        "processData": false,
        "mimeType": "multipart/form-data",
        "contentType": false,
    })

    function fixMaterial() {
        $((function () {
            $sidebar = $('.sidebar');
            $sidebar_img_container = $sidebar.find('.sidebar-background');
            $full_page = $('.full-page');
            $sidebar_responsive = $('body > .navbar-collapse');
            window_width = $(window).width();
            fixed_plugin_open = $('.sidebar .sidebar-wrapper .nav li.active a p').html();
            if (window_width > 767 && fixed_plugin_open == 'Dashboard') {
                if ($('.fixed-plugin .dropdown').hasClass('show-dropdown')) {
                    $('.fixed-plugin .dropdown').addClass('open');
                }
            }
            $('.fixed-plugin a').click(function (event) { 
                // Alex if we click on switch, stop propagation of the event, so the dropdown will not be hide, otherwise we set the  section active
                if ($(this).hasClass('switch-trigger')) {
                    if (event.stopPropagation) {
                        event.stopPropagation();
                    } else if (window.event) {
                        window.event.cancelBubble = true;
                    }
                }
            });
            
            $('.fixed-plugin .active-color span').click(function () {
                $full_page_background = $('.full-page-background');
                $(this).siblings().removeClass('active');
                $(this).addClass('acti  ve');
                var new_color = $(this).data('color');
                if ($sidebar.length != 0) {
                    $sidebar.attr('data-color', new_color);
                }
                if ($full_page.length != 0) {
                    $full_page.attr('filter-color', new_color);
                }
                if ($sidebar_responsive.length != 0) {
                    $sidebar_responsive.attr('data-color', new_color);
                }
            })
        }))
    }

    function addPrototypeFormData() {
        FormData.prototype.fromObject = function (this: FormData, obj) {
            if (typeof obj !== 'object') return
            for (let [key, value] of Object.entries(obj)) {
                if (value instanceof Array) {
                    key += '[]'
                    for (let v of value) {
                        this.append(key, v)
                    }
                } else {
                    this.append(key, value)
                }
            }
            return this
        }
    }

    function fixTooltip() {
        $.fn._tooltip = $.fn.tooltip
        $.fn.tooltip = function (selector) {
            return this._tooltip(selector).off('focusin')
        }
    }

    function addHTMLTableElementPrototype() {
        HTMLTableElement.prototype._loadBodyTable = function (this: HTMLTableElement, body) {
            $(this).find('tbody').html(body)
            if (this._eventsLoadBody instanceof Array)
                for (let evt of this._eventsLoadBody)
                    evt(this)
        }
        HTMLTableElement.prototype._onLoadTableBody = function (this: HTMLTableElement, eventHandler) {
            if (eventHandler instanceof Function) {
                if (!(this._eventsLoadBody instanceof Array)) this._eventsLoadBody = []
                this._eventsLoadBody.push(eventHandler)
            }
        }
        HTMLTableElement.prototype._eachSelected = function (this: HTMLTableElement, callback) {
            for (let tr of $(this).children('tbody').children('tr')) {
                if (tr._select[0].checked) callback(tr)
            }
        }
        HTMLTableElement.prototype._mapSelected = function (this: HTMLTableElement, callback) {
            const output = []
            for (let tr of $(this).children('tbody').children('tr')) {
                if (tr._select[0].checked) output.push(callback(tr))
            }
            return output
        }
    }
    /**
     * Thêm $.fn.validateCustom ( dùng cho input viết từ component )
     */
    function addJqueryValidationCustom() {

        // Custom jquery validation sang tiếng việt
        $.extend($.validator.messages, {
            required: "Thông tin này là bắt buộc.",
            remote: "Hãy sửa cho đúng.",
            email: "Hãy nhập email.",
            url: "Hãy nhập URL.",
            date: "Hãy nhập ngày.",
            dateISO: "Hãy nhập ngày (ISO).",
            number: "Hãy nhập số.",
            digits: "Hãy nhập chữ số.",
            creditcard: "Hãy nhập số thẻ tín dụng.",
            equalTo: "Hãy nhập thêm lần nữa.",
            extension: "Phần mở rộng không đúng.",
            maxlength: $.validator.format("Hãy nhập từ {0} kí tự trở xuống."),
            minlength: $.validator.format("Hãy nhập từ {0} kí tự trở lên."),
            rangelength: $.validator.format("Hãy nhập từ {0} đến {1} kí tự."),
            range: $.validator.format("Hãy nhập từ {0} đến {1}."),
            max: $.validator.format("Hãy nhập từ {0} trở xuống."),
            min: $.validator.format("Hãy nhập từ {0} trở lên.")
        });

        // Thêm hàm validate custom cho form của material ( viết từ component)
        $.fn.validateCustom = function (validate) {

            // Thêm message và icon feed-back
            for (let nameInput of Object.keys(validate.rules)) {
                let element = this.find(`[name="${nameInput}"]`)
                let invalidFeedback = $('<span class="invalid-feedback d-block"></span>')
                switch (element.attr('type')) {
                    case 'checkbox':
                    case 'radio':
                        element.closest('.form-check').attr('parent', '')
                        invalidFeedback.insertAfter(element.parent())
                        break
                    default:
                        element.closest('.form-group').attr('parent', '')
                        $('<span class="form-control-feedback"><i class="fas"></i></span>')
                            .insertAfter(element)
                        invalidFeedback.insertAfter(element)
                }
            }

            const validator = this.validate({
                ...validate,
                ...{
                    lang: 'vi',
                    highlight: function (element) {
                        const cacheValue = getCache(element)
                        console.log(cacheValue, element)
                        if (cacheValue) {
                            cacheValue.parent.addClass('has-danger')
                            cacheValue.iconFeedback.removeClass('fa-check')
                                .addClass(
                                    'fa-exclamation')
                        }
                    },
                    unhighlight: function (element) {
                        const cacheValue = getCache(element)
                        if (cacheValue) {
                            cacheValue.parent.removeClass('has-danger')
                                .addClass('has-success')
                            cacheValue.iconFeedback.addClass('fa-check')
                                .removeClass(
                                    'fa-exclamation')
                        }
                    },
                    errorPlacement: function (error, element) {
                        element.closest('[parent]').find(
                            '.invalid-feedback').append(error)
                    }
                }
            })

            /**
             * cache lại các element (dùng cho event highlight/unhighlight của jquery validation)
             * @param element 
             */
            function getCache(element) {
                const cache = {};
                getCache = function (element) {
                    let cacheValue = cache[element.name]
                    if (!cacheValue) {
                        cacheValue = {}
                        switch (element.type) {
                            case 'checkbox':
                            case 'radio':
                                $(element).closest('.form-check').find('.invalid-feedback.default').remove()
                                return
                            default:
                                cacheValue.parent = $(element).closest(
                                    '.form-group')
                                cacheValue.invalidFeedback = $(element).parent()
                                    .next(
                                        '.invalid-feedback')
                                cacheValue.iconFeedback = $(element).parent().find('.form-control-feedback > .fas')
                                cacheValue.parent.removeClass('has-danger').find('.invalid-feedback.default').remove()
                                cacheValue.parent.find('.form-control-feedback.default').remove()
                        }
                        cache[element.name] = cacheValue
                    }
                    return cacheValue
                }
                return getCache(element)
            }
            return validator
        }
    }

    /**
     * Thêm $.fn._autoIndexTable ( Tự động đánh index cho table )
     */
    function addJqueryTableAutoIndex() {
        $.fn._autoIndexTable = function (this: JQuery<HTMLElement>) {
            this.each((i, element) => {
                const table = $(element)
                const trHead = table.find('thead > tr')
                if (!trHead.find('.auto-index-head')[0]) {
                    trHead.prepend($('<th class="auto-index-head"><strong>#</strong></th>'))
                    element._onLoadTableBody(function () { table._autoIndexTable() })
                }
                table.children('tbody').children('tr').each((i, tr) => {
                    if (!tr._ai) { tr._ai = $('<td ai></td>'); tr.prepend(tr._ai[0]) }
                    tr._ai.html(i + 1)
                })
            })
            return this
        }
    }

    function addSelectModeTable() {
        const checkbox = `<div class="form-check"><label class="form-check-label"><input class="form-check-input " type="checkbox"><span class="form-check-sign"><span class="check"></span></span></label></div>`;
        $.fn._addSelectRows = function () {
            this.each(function (i, e) {
                const table = $(e);
                const trHead = table.find('thead > tr');
                // Tự động thêm checkbox select vào header (nếu không tồn tại)
                if (!trHead.find('th.select')[0]) {
                    trHead.prepend(
                        $(`<th class="select"></th>`).html((function () {
                            const cbSelectAll = $(checkbox)
                            const selectToolTipText = ['<span class="text-danger">Hủy chọn tất cả</span>', '<span class="text-success">Chọn tất cả</span>']
                            // Thêm tooltip attribute
                            cbSelectAll.attr('data-toggle', 'tooltip').attr('data-html', 'true').attr('title', selectToolTipText[1])
                            // Chọn hoặc hủy tất cả lựa chọn trong table
                            cbSelectAll.find('input').on('change', function (evt) {
                                const check = this.checked
                                const message = selectToolTipText[check ? 0 : 1]
                                cbSelectAll.attr('data-original-title', message)
                                // Tìm thẻ tooltip đang được view và thay đổi trực tiếp content bên trong
                                $(`#${cbSelectAll.attr('aria-describedby')} > .tooltip-inner`).html(message)
                                table.find('tbody > tr').each(function (i, tr) { tr._select[0].checked = check })
                            })
                            cbSelectAll.tooltip()
                            return cbSelectAll
                        })()))
                    e._onLoadTableBody(function () { table._addSelectRows() })
                }
                table.children('tbody').children('tr').each((i, e) => {
                    if (!e._select) {
                        const jCheckbox = $(checkbox)
                        e._select = jCheckbox.find('input');
                        e.prepend($('<td sl></td>').append(jCheckbox)[0])
                    }
                })
            });
            return this;
        };
    }

})()
