define(["require", "exports", "./utils"], function (require, exports, utils_1) {
    "use strict";
    Object.defineProperty(exports, "__esModule", { value: true });
    exports.layoutAction = void 0;
    const DATA_CONFIG_ATTRIBUTE = 'data-config';
    exports.layoutAction = {
        rebuild: {
            tooltip: () => $('[data-toggle="tooltip"]').tooltip(),
            popover: () => $('[data-toggle="popover"]').popover(),
            autoAddSelectColumn() { $('table[select]')._addSelectRows().removeClass('select'); },
            autoIndexTable() { $('table[auto-index]')._autoIndexTable().removeClass('auto-index'); },
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
            },
            removeErrorInput(jElement = $('body')) {
                jElement.find('.form-group,.form-check').each(function (index, e) {
                    if ($(this).find('.invalid-feedback')[0]) {
                        $(this).find('input').on('input', function _event() {
                            $(this).off('input', _event);
                            $(e).removeClass('has-danger').find('.invalid-feedback.default').remove();
                            $(e).find('.form-control-feedback.default').remove();
                        });
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
