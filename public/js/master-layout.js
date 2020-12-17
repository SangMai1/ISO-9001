(function () {
    addJqueryValidationCustom();
    addJqueryTableAutoIndex();
    addSelectModeTable();
    fixTooltip();
    function fixTooltip() {
        $.fn._tooltip = $.fn.tooltip;
        $.fn.tooltip = function (selector) {
            return this._tooltip(selector).off('focusin');
        };
    }
    function addJqueryValidationCustom() {
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
        $.fn.validateCustom = function (validate) {
            for (let nameInput of Object.keys(validate.rules)) {
                let element = this.find(`[name="${nameInput}"]`);
                let invalidFeedback = $('<span class="invalid-feedback d-block"></span>');
                switch (element.attr('type')) {
                    case 'checkbox':
                    case 'radio':
                        element.closest('.form-check').attr('parent', '');
                        invalidFeedback.insertAfter(element.parent());
                        break;
                    default:
                        element.closest('.form-group').attr('parent', '');
                        $('<span class="form-control-feedback"><i class="fas"></i></span>')
                            .insertAfter(element);
                        invalidFeedback.insertAfter(element);
                }
            }
            const validator = this.validate(Object.assign(Object.assign({}, validate), {
                lang: 'vi',
                highlight: function (element) {
                    const cacheValue = getCache(element);
                    console.log(cacheValue, element);
                    if (cacheValue) {
                        cacheValue.parent.addClass('has-danger');
                        cacheValue.iconFeedback.removeClass('fa-check')
                            .addClass('fa-exclamation');
                    }
                },
                unhighlight: function (element) {
                    const cacheValue = getCache(element);
                    if (cacheValue) {
                        cacheValue.parent.removeClass('has-danger')
                            .addClass('has-success');
                        cacheValue.iconFeedback.addClass('fa-check')
                            .removeClass('fa-exclamation');
                    }
                },
                errorPlacement: function (error, element) {
                    element.closest('[parent]').find('.invalid-feedback').append(error);
                }
            }));
            function getCache(element) {
                const cache = {};
                getCache = function (element) {
                    let cacheValue = cache[element.name];
                    if (!cacheValue) {
                        cacheValue = {};
                        switch (element.type) {
                            case 'checkbox':
                            case 'radio':
                                $(element).closest('.form-check').find('.invalid-feedback.default').remove();
                                return;
                            default:
                                cacheValue.parent = $(element).closest('.form-group');
                                cacheValue.invalidFeedback = $(element).parent()
                                    .next('.invalid-feedback');
                                cacheValue.iconFeedback = $(element).parent().find('.form-control-feedback > .fas');
                                cacheValue.parent.removeClass('has-danger').find('.invalid-feedback.default').remove();
                                cacheValue.parent.find('.form-control-feedback.default').remove();
                        }
                        cache[element.name] = cacheValue;
                    }
                    return cacheValue;
                };
                return getCache(element);
            }
            return validator;
        };
    }
    function addJqueryTableAutoIndex() {
        $.fn._autoIndexTable = function () {
            this.each((i, e) => {
                const table = $(e);
                const trHead = table.find('thead > tr');
                if (!trHead.find('.auto-index-head')[0])
                    trHead.prepend($('<th class="auto-index-head"><strong>#</strong></th>'));
                table.children('tbody').children('tr').each((i, tr) => {
                    if (!tr._ai) {
                        tr._ai = $('<td ai></td>');
                        tr.prepend(tr._ai[0]);
                    }
                    tr._ai.html(i + 1);
                });
            });
            return this;
        };
    }
    function addSelectModeTable() {
        const checkbox = `<div class="form-check"><label class="form-check-label"><input class="form-check-input " type="checkbox"><span class="form-check-sign"><span class="check"></span></span></label></div>`;
        $.fn._addSelectRows = function () {
            this.each(function (i, e) {
                const table = $(e);
                const trHead = table.find('thead > tr');
                if (!trHead.find('th.select')[0])
                    trHead.prepend($(`<th class="select"></th>`).html((function () {
                        const cbSelectAll = $(checkbox);
                        const selectToolTipText = ['<span class="text-danger">Hủy chọn tất cả</span>', '<span class="text-success">Chọn tất cả</span>'];
                        cbSelectAll.attr('data-toggle', 'tooltip').attr('data-html', 'true').attr('title', selectToolTipText[1]);
                        cbSelectAll.find('input').on('change', function (evt) {
                            const check = this.checked;
                            const message = selectToolTipText[check ? 0 : 1];
                            cbSelectAll.attr('data-original-title', message);
                            $(`#${cbSelectAll.attr('aria-describedby')} > .tooltip-inner`).html(message);
                            table.find('tbody > tr').each(function (i, tr) { tr._select[0].checked = check; });
                        });
                        cbSelectAll.tooltip();
                        return cbSelectAll;
                    })()));
                table.children('tbody').children('tr').each((i, e) => {
                    if (!e._select) {
                        const jCheckbox = $(checkbox);
                        e._select = jCheckbox.find('input');
                        e.prepend($('<td sl></td>').append(jCheckbox)[0]);
                    }
                });
                table[0]._eachSelected = function (callback) {
                    table.find('tbody > tr').each(function (i, tr) {
                        if (tr._select[0].checked)
                            callback(tr);
                    });
                };
            });
            return this;
        };
    }
})();
