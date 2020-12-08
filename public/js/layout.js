define(["require", "exports", "./utils"], function (require, exports, utils_1) {
    "use strict";
    Object.defineProperty(exports, "__esModule", { value: true });
    exports.layoutAction = void 0;
    exports.layoutAction = {
        rebuildAll() {
            $('[data-toggle="tooltip"]').tooltip().unbind('focusin');
            $('[data-toggle="popover"]').popover();
            exports.layoutAction.autoIndexTable();
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
        autoIndexTable() {
            $('.table-responsive[auto-index="true"]').each((i, e) => {
                const table = $(e).removeAttr('auto-index').find('table');
                if (!table[0])
                    return;
                table.find('thead > tr').prepend($('<th><strong>#</strong></th>'));
                table.find('tbody > tr').each((i, e) => $(e).prepend((`<td><em>${i + 1}</em></td>`)));
            });
        }
    };
    window.layoutAction = exports.layoutAction;
    $(() => {
        exports.layoutAction.rebuildAll();
        rebuildSidebarCollapse();
        activeFromMenuTag();
        function activeFromMenuTag() {
            const activeMenuTag = $('#active-menu');
            if (!activeMenuTag)
                return;
            let config = activeMenuTag.attr('active') || { href: activeMenuTag.attr('href') };
            exports.layoutAction.activeMenu(config);
        }
        function rebuildSidebarCollapse() {
            const sidebar = $('.nav');
            sidebar.find('[data-toggle="collapse"]:not([href])').each(function (i, e) {
                const id = utils_1.Utils.randomString(15);
                const collapse = $(e).next('.collapse');
                if (collapse[0]) {
                    collapse.attr('id', id);
                    e.href = '#' + id;
                }
            });
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
