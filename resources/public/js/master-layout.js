(function () {
    addJqueryValidationCustom()
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
})()
