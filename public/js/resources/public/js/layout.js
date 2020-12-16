define(["require", "exports", "./utils"], function (require, exports, utils_1) {
    "use strict";
    Object.defineProperty(exports, "__esModule", { value: true });
    exports.layoutAction = void 0;
    const DATA_CONFIG_ATTRIBUTE = 'data-config';
    console.log('first');
    exports.layoutAction = {
        rebuild: {
            tooltip: () => $('[data-toggle="tooltip"]').tooltip().unbind('focusin'),
            popover: () => $('[data-toggle="popover"]').popover(),
            autoIndexTable() {
                $('.table-responsive[auto-index="true"]').each((i, e) => {
                    const table = $(e).removeAttr('auto-index').find('table');
                    if (!table[0])
                        return;
                    table.find('thead > tr').prepend($('<th><strong>#</strong></th>'));
                    table.find('tbody > tr').each((i, e) => $(e).prepend((`<td><em>${i + 1}</em></td>`)));
                });
            },
            activeFromMenuTag() {
                const activeMenuTag = $('#active-menu');
                if (!activeMenuTag)
                    return;
                let config = activeMenuTag.attr('active') || { href: activeMenuTag.attr('href') };
                exports.layoutAction.activeMenu(config);
            }
        },
        activeMenu(menu) {
            const navBar = $('.nav:not(.navbar-nav)');
            exports.layoutAction.activeMenu = function (menu) {
                navBar.find('.active').removeClass('active');
                const activeTag = menu instanceof Object && menu.href
                    ? navBar.find(`[href="${menu.href}"]`)
                    : navBar.find(`li [active="${menu}"]`);
                if (!activeTag[0])
                    return;
                activeTag.closest('.nav-item').addClass('active');
                let closestUlTag = activeTag;
                while (true) {
                    closestUlTag = closestUlTag.parent().closest('ul');
                    if (closestUlTag[0] === navBar[0] || !closestUlTag[0])
                        break;
                    closestUlTag.collapse('show');
                }
            };
            exports.layoutAction.activeMenu(menu);
        },
        getAllConfig() {
            const config = {};
            $('config').each((i, e) => {
                const configTag = $(e);
                const configForTag = $(configTag.attr('href') || configTag.prev());
                if (configForTag[0]) {
                    try {
                        const key = utils_1.Utils.randomString(15);
                        config[key] = eval(configTag.html());
                        configForTag.attr(DATA_CONFIG_ATTRIBUTE, key);
                    }
                    catch (error) { }
                }
                configTag.remove();
            });
            window.$config = config;
        },
        readConfig(selector) {
            return window.$config[$(selector).attr(DATA_CONFIG_ATTRIBUTE)] || {};
        },
        renders: {
            collapse() {
                $('[data-toggle="collapse"]:not([href]):not([data-target])').each(function (i, e) {
                    const id = utils_1.Utils.randomString(15);
                    const collapse = $(e).next('.collapse');
                    if (collapse[0]) {
                        collapse.attr('id', id);
                        if (e.tagName === 'A')
                            e.href = '#' + id;
                        else
                            e.setAttribute('data-target', '#' + id);
                    }
                });
            }
        }
    };
    window.layoutAction = exports.layoutAction;
    $(() => {
        utils_1.Utils.activeAllActionFromObject(exports.layoutAction.renders);
        exports.layoutAction.getAllConfig();
        utils_1.Utils.activeAllActionFromObject(exports.layoutAction.rebuild);
        addJqueryValidationCustom();
        console.log('done');
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
                    let invalidFeedback = element.next('.invalid-feedback').addClass('d-block');
                    if (!invalidFeedback[0])
                        invalidFeedback = $('<span class="invalid-feedback d-block"></span>');
                    switch (element.attr('type')) {
                        case 'checkbox':
                        case 'radio':
                            element.closest('.form-check').attr('parent', '');
                            invalidFeedback.insertAfter(element.parent());
                            break;
                        default:
                            element.closest('.form-group').attr('parent', '');
                            $('<span class="form-control-feedback"><i class="fas fa-check"></i></span>')
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
                            cacheValue.iconFeedback.removeClass('fa-check').addClass('fa-exclamation');
                        }
                    },
                    unhighlight: function (element) {
                        const cacheValue = getCache(element);
                        if (cacheValue) {
                            cacheValue.parent.removeClass('has-danger').addClass('has-success');
                            cacheValue.iconFeedback.addClass('fa-check').removeClass('fa-exclamation');
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
                                    return;
                                default:
                                    cacheValue.parent = $(element).closest('.form-group');
                                    cacheValue.invalidFeedback = $(element).parent().next('.invalid-feedback');
                                    cacheValue.iconFeedback = $(element).parent().find('.form-control-feedback > .fas');
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
        window.module = window.require.s.contexts._.defined;
        window.getModule = function (moduleName) {
            const moduleConfig = {
                utils: 'utils.Utils'
            };
            if (moduleConfig[moduleName])
                return eval(`window.module.${moduleConfig[moduleName]}`);
            return window.module[module];
        };
    });
});
