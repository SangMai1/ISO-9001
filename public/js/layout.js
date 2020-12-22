const DATA_CONFIG_ATTRIBUTE = 'data-config';
const layoutAction = {
    rebuild: {
        tooltip: (selector = $('body')) => selector.find('[data-toggle="tooltip"]').tooltip(),
        popover: (selector = $('body')) => selector.find('[data-toggle="popover"]').popover(),
        autoBmd(selector) {
            if ((selector = $(selector))[0]) {
                selector.find('.btn').bmdRipples();
                selector.find('.form-control').bmdText();
                selector.find('.selectpicker').selectpicker();
            }
        },
        autoFormEvent(selector = $('body')) {
            selector.find('form[ajax-form]').on('submit', function (evt) {
                evt.preventDefault();
                if (!$(this).valid())
                    return;
                const postHref = this.getAttribute('action');
                $.ajax({
                    url: postHref,
                    data: new FormData(this),
                    error: (resp) => {
                        Swal.close();
                        if (resp.getResponseHeader('content-type').toLowerCase() !== 'application/json')
                            return;
                        const result = JSON.parse(resp.responseText);
                        if (result.message !== 'The given data was invalid.')
                            return;
                        for (let [fieldName, error] of Object.entries(result.errors)) {
                            const input = $(this).find(`[name="${fieldName}"]`);
                            if (input[0])
                                input[0]._setBmdError(error);
                        }
                        layoutAction.renders.removeErrorInput($(this));
                    }
                });
            });
        },
        autoAddDeleteEventTable(selector = $('body')) {
            selector.find('table[delete-href]').each(function (i, table) {
                table = $(table);
                const deleteHref = table.attr('delete-href');
                table.find('tbody > tr > td.td-action .delete-btn').on('click', function (evt) {
                    const tr = $(this).closest('tr');
                    const id = tr.data('id');
                    $.ajax({ url: deleteHref, data: (new FormData()).fromObject({ id: id, _token: token }) })
                        .done(() => {
                        tr.remove();
                        if (table.find('thead > tr > .auto-index-head')[0])
                            table._autoIndexTable();
                    });
                });
            });
        },
        autoAddSelectColumn(selector = $('body')) { selector.find('table[select]')._addSelectRows().removeClass('select'); },
        autoIndexTable(selector = $('body')) { selector.find('table[auto-index]')._autoIndexTable().removeClass('auto-index'); },
        activeFromMenuTag() {
            const activeMenuTag = $('#active-menu');
            if (!activeMenuTag)
                return;
            let config = activeMenuTag.attr('active') || { href: activeMenuTag.attr('href') };
            layoutAction.activeMenu(config);
        }
    },
    activeMenu(menu) {
        const navBar = $('.nav:not(.navbar-nav)');
        layoutAction.activeMenu = function (menu) {
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
        layoutAction.activeMenu(menu);
    },
    getAllConfig() {
        const config = {};
        $('config').each((i, e) => {
            const configTag = $(e);
            const configForTag = $(configTag.attr('href') || configTag.prev());
            if (configForTag[0]) {
                try {
                    const key = Utils.randomString(15);
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
        collapse(selector = $('body')) {
            $(selector).find('[data-toggle="collapse"]:not([href]):not([data-target])').each(function (i, e) {
                const id = Utils.randomString(15);
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
        cardTab(selector = $('body')) {
            selector.find('[find-header]').each(function (i, cardBody) {
                const ulHead = $(cardBody).parent().find('.card-header ul.nav-tabs')[0];
                const tabHeads = $(ulHead).find(`[data-toggle="tab"]`);
                $(cardBody).children('.tab-content').children('.tab-pane').each(function (i, tabPane) {
                    const id = Utils.randomString(15);
                    if (i > tabHeads.length)
                        return;
                    tabHeads[i].setAttribute('href', `#${id}`);
                    tabPane.id = id;
                });
            });
        },
        tableMobile(selector = $('body')) {
            selector.find('table.mobile').each(function (i, table) {
                const classId = Utils.randomString(15);
                if (table.getAttribute('cell-fix') != undefined)
                    return;
                $(table).addClass(classId).attr('cell-fix', '');
                const headersStyle = $(table).children('thead').children('tr')
                    .children('th:not(.auto-index-head):not(.select):not(.th-mobile):not(.th-action)')
                    .toArray()
                    .reduce((prev, th, index) => prev += `table.${classId} > tbody > tr > td .cell:not(.no-title)[index="${index + 1}"]::before{ content: '${th.getAttribute('mobile-head') || th.textContent}: ' }\n`, '');
                const styleElement = document.createElement('style');
                styleElement.innerHTML = headersStyle;
                document.head.append(styleElement);
                table._onLoadTableBody(loadTable);
                table._onLoadTableBody(() => layoutAction.rebuild.autoBmd(table));
                table._onLoadTableBody(() => layoutAction.renders.collapse(table));
                loadTable.bind(table)();
            });
            function loadTable() {
                $(this).children('tbody').children('tr').each(function (i, tr) {
                    if (tr._cellRender)
                        return;
                    const tds = $(tr).children('td:not([ai]):not([sl]):not(.td-mobile):not(.td-action)');
                    $(tr).find('.cell').each(function (i, cell) {
                        const index = cell.getAttribute('index') - 1;
                        cell.innerHTML = (tds[index] && tds[index].innerHTML) || `<div class="text-danger">Not Found Cell Index ${index}</div>`;
                        tr._cellRender = true;
                    });
                });
            }
        },
        removeErrorInput(jElement = $('body')) {
            jElement.find('.form-group,.form-check').each(function (index, e) {
                if ($(this).find('.invalid-feedback')[0]) {
                    $(this).find('input').on('input', function _event() {
                        $(this).off('input', _event);
                        this._setBmdError();
                    });
                }
            });
        }
    }
};
$(() => {
    Utils.activeAllActionFromObject(layoutAction.renders);
    layoutAction.getAllConfig();
    showAlert($('body'));
    Utils.activeAllActionFromObject(layoutAction.rebuild);
});
