// @ts-ignore
//@ts-nocheck
$(() => { window.token = document.querySelector('.csrf-token > input').value })
const _swalConfig: { [key: string]: SweetAlertOptions } = {}
var Toast: SwalInterface
const showLoading = function (message = "Chờ xí ...") { Toast.fire({ title: message, showCloseButton: false, didOpen: () => Swal.showLoading() }) };
const showAlert = function (html: JQuery<HTMLElement>) {
    html = $(html)
    let message = $(html).hasClass('alert-message') ? html.text() : $('.alert-message', $(html)).text()
    const _typeAlert = _swalConfig[message]
    if (_typeAlert) return Swal.fire(_typeAlert)
    else if (message)
        try {
            message = eval(`(()=>(${message}))()`);
            if (typeof message === 'object') return Swal.fire({ ... (_swalConfig[message._type] || _swalConfig.toast), ...message })
        } catch (error) { console.log(message) }

    Swal.close()
};


(function () {
    addJqueryValidationCustom()
    addJqueryTableAutoIndex()
    addSelectModeTable()
    addHTMLTableElementPrototype()
    addPrototypeInput()
    addPrototypeFormData()
    fixTooltip()
    configSweetAlert()

    $(() => fixMaterial())


    $.ajaxSetup({
        "processData": false,
        "mimeType": "multipart/form-data",
        "contentType": false,
        "method": 'POST',
        "beforeSend": () => showLoading(),
        "success": (resp) => showAlert(resp),
        "error": () => Swal.fire(_swalConfig.errorAjax)
    })

    function configSweetAlert() {
        swal = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success btn-sm',
                cancelButton: 'btn btn-danger btn-sm',
                denyButton: 'btn btn-primary btn-warning btn-sm'
            },
            didOpen: () => {
                layoutAction.rebuild.autoBmd('.swal2-popup')
            },
            buttonsStyling: false
        })

        //#region swal_config
        _swalConfig.toast = {
            toast: true,
            position: 'top-right',
            showConfirmButton: false,
            showCloseButton: true,
            didOpen: (toast) => {
                layoutAction.rebuild.autoBmd('.swal2-popup')
                toast.addEventListener('mouseenter', window.Swal.stopTimer)
                toast.addEventListener('mouseleave', window.Swal.resumeTimer)
            },
            buttonsStyling: false
        }

        _swalConfig.toastTime = { ..._swalConfig.toast, timer: 1500 }
        _swalConfig.errorAjax = { ..._swalConfig.toastTime, title: 'Lỗi khi gửi Request', icon: 'error' }
        _swalConfig.addSuccess = { ..._swalConfig.toastTime, title: 'Thêm thành công', icon: 'success' }
        _swalConfig.addError = { ..._swalConfig.toastTime, title: 'Thêm thất bại', icon: 'error' }
        _swalConfig.updateSuccess = { ..._swalConfig.toastTime, title: 'Cập nhật thành công', icon: 'success' }
        _swalConfig.updateFailed = { ..._swalConfig.toastTime, title: 'Cập nhật thất bại', icon: 'error' }
        _swalConfig.deleteSuccess = { ..._swalConfig.toastTime, title: 'Xóa thành công', icon: 'success' }
        _swalConfig.deleteFailed = { ..._swalConfig.toastTime, title: 'Xóa thất bại', icon: 'error' }
        //#endregion

        Toast = Swal.mixin(_swalConfig.toast)
    }

    // fix lỗi màn hình đen menu không kéo hết :V
    function fixMaterial() {
        const style = document.createElement('style')
        document.head.append(style)
        $('.navbar-toggler').on('click', function () {
            style.innerHTML = `.close-layer.visible{ height: ${$('.main-panel')[0].scrollHeight}px !important`
        })
    }

    function addPrototypeFormData() {
        FormData.prototype.fromObject = function (this: FormData, obj) {
            if (typeof obj !== 'object') return
            obj._token = window.token
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
        const addBody = (table, action, body) => {
            $(table).find('tbody')[action](body)
            if (table._eventsLoadBody instanceof Array)
                for (let evt of table._eventsLoadBody)
                    evt(table, body)
        }

        HTMLTableElement.prototype._loadBodyTable = function (this: HTMLTableElement, body) { addBody(this, 'html', body) }
        HTMLTableElement.prototype._appendBodyTable = function (this: HTMLTableElement, body) { addBody(this, 'append', body) }
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

    function addPrototypeInput() {
        const getFeedBack = (parent) => {
            let feedback = $(parent).find('.invalid-feed-back')
            feedback = feedback[0] ? feedback : $('<span class="invalid-feedback d-block"></span>')
            feedback.html('')
            return feedback
        }
        const getFormControlFeedback = (parent) => {
            let controlFeedback = $(parent).find('.form-control-feedback')
            controlFeedback = controlFeedback[0] ? controlFeedback : $('<span class="form-control-feedback"></span>')
            controlFeedback.html($('<i class="fas fa-check"></i>'))
            return controlFeedback
        }

        HTMLElement.prototype._setBmdError = function (this: HTMLElement, error: string) {
            switch ($(this).attr('type')) {
                case 'checkbox':
                case 'radio':
                    {
                        const parent = $(this).closest('.form-check')
                        if (!parent[0]) return

                        const feedback = getFeedBack(parent)
                        parent.append(feedback)

                        this._setBmdError = function (error) {
                            feedback.html(error || '')
                        }
                        this._setBmdError(error)
                    }
                    break
                default:
                    {
                        const parent = $(this).closest('.form-group')
                        if (!parent[0]) return

                        const feedback = getFeedBack(parent)
                        const formControlFeedback = getFormControlFeedback(parent)
                        const iconFeedback = formControlFeedback.children('i')

                        parent.append(feedback).append(formControlFeedback)
                        let oldStatus = undefined

                        this._setBmdError = function (error: string) {
                            feedback.html(error || '')
                            if (error) {
                                if (oldStatus !== false) {
                                    parent.removeClass('has-success').addClass('has-danger')
                                    iconFeedback.addClass('fa-exclamation').removeClass('fa-check')
                                }
                            } else {
                                if (oldStatus !== true) {
                                    parent.addClass('has-success').removeClass('has-danger')
                                    iconFeedback.removeClass('fa-exclamation').addClass('fa-check') 
                                }
                            }
                        }

                        this._setBmdError(error)
                    }
            }
        }
    }
    /**
     * Thêm $.fn.validateCustom ( dùng cho input viết từ component )
     */
    function addJqueryValidationCustom() {
        // add regex
        $.validator.addMethod(
            "regex",
            function (value, element, regexp) {
                var re = new RegExp(regexp);
                return this.optional(element) || re.test(value);
            },
            "Thông tin không hợp lệ"
        )
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
            const validator = this.validate({
                ...validate,
                ...{
                    lang: 'vi',
                    highlight: function (element) {
                        element._setBmdError(this.submitted[element.name])

                        // Dùng để fix lỗi setError chồng lên nhau -> Thứ tự ưu tiên
                        // element._errorLevel = 100 
                    },
                    unhighlight: function (element) {
                        element._setBmdError()
                    },
                    errorPlacement: (error) => { }
                }
            })

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
