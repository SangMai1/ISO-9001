//@ts-nocheck
// @ts-ignore
const DATA_CONFIG_ATTRIBUTE = 'data-config'

const layoutAction = {
    rebuild: {
        tooltip: (selector = $('body')) => selector.find('[data-toggle="tooltip"]').tooltip(),
        popover: (selector = $('body')) => selector.find('[data-toggle="popover"]').popover(),
        autoBmd(selector) {
            if ((selector = $(selector))[0]) {
                selector.find('.btn').bmdRipples()
                selector.find('.form-control').bmdText()
                selector.find('.selectpicker').selectpicker()
            }
        },
        autoFormEvent(selector = $('body')) {
            selector.find('form[ajax-form]').on('submit', function (evt) {
                evt.preventDefault()
                if (!$(this).valid()) return
                const postHref = this.getAttribute('action')
                $.ajax({
                    url: postHref,
                    data: new FormData(this),
                    error: function (resp) {
                        console.log(resp)

<<<<<<< HEAD
                    }
                })
=======
                if (!table[0] || !deleteHref) return
                deleteBtn.on('click', function () {
                    const idsSelected = table[0]._mapSelected(tr => $(tr).data('id'));
                    showLoading()
                    $.ajax({
                        method: "POST",
                        url: deleteHref,
                        data: new FormData().fromObject({ ids: idsSelected, _token: token }),
                    }).done(function (resp) {
                        const message = getMessage(resp)
                        try {
                            window[message._type].fire(message)
                        } catch (error) {
                            
                        }
                        table[0]._loadBodyTable($('tbody > tr', $(resp)));
                    }).fail(() => window.Swal.closeToast())
                });
>>>>>>> 8a14531affa6390bb05584b1108a771bb4586d79
            })
        },
        /**
         * Tự động thêm cột select cho table
         */
        autoAddSelectColumn(selector = $('body')) { selector.find('table[select]')._addSelectRows().removeClass('select') },
        /**
         * Tự động thêm cột index cho table có attribute auto-index
        */
        autoIndexTable(selector = $('body')) { selector.find('table[auto-index]')._autoIndexTable().removeClass('auto-index') },
        /**
         * Auto kích hoạt menu thừ thẻ active menu @activeMenuTag snippet
         */
        activeFromMenuTag() {
            const activeMenuTag = $('#active-menu')
            if (!activeMenuTag) return
            let config = activeMenuTag.attr('active') || { href: activeMenuTag.attr('href') }
            layoutAction.activeMenu(config)
        }
    },
    /**
     * 
     * @param menu string | jquery selector
     */
    activeMenu(menu: string | { href: string }) {
        const navBar = $('.nav:not(.navbar-nav)')
        layoutAction.activeMenu = function (menu) {
            navBar.find('.active').removeClass('active')
            const activeTag = menu instanceof Object && menu.href
                ? navBar.find(`[href="${menu.href}"]`)
                : navBar.find(`li [active="${menu}"]`)
            if (!activeTag[0]) return
            activeTag.closest('.nav-item').addClass('active')
            let closestUlTag = activeTag

            while (true) {
                closestUlTag = closestUlTag.parent().closest('ul')
                if (closestUlTag[0] === navBar[0] || !closestUlTag[0]) break
                closestUlTag.collapse('show')
            }
        }
        layoutAction.activeMenu(menu)
    },
    /**
     * Đọc tất config từ html tag config và chuyển html trong tag đó thành thành obj javascript => sử dụng eval
     */
    getAllConfig() {
        const config = {}
        $('config').each((i, e) => {
            const configTag = $(e)
            const configForTag = $(configTag.attr('href') || configTag.prev())
            if (configForTag[0]) {
                try {
                    const key = Utils.randomString(15)
                    config[key] = eval(configTag.html())
                    configForTag.attr(DATA_CONFIG_ATTRIBUTE, key)
                } catch (error) { }
            }
            configTag.remove()
        })
        window.$config = config
    },
    /**
     * Đọc config từ html element
     * @param selector selector jquery
     */
    readConfig(selector) {
        return window.$config[$(selector).attr(DATA_CONFIG_ATTRIBUTE)] || {}
    },
    renders: {
        collapse(selector = $('body')) {
            $(selector).find('[data-toggle="collapse"]:not([href]):not([data-target])').each(function (i, e) {
                const id = Utils.randomString(15)
                const collapse = $(e).next('.collapse')
                if (collapse[0]) {
                    collapse.attr('id', id)
                    if (e.tagName === 'A')
                        e.href = '#' + id
                    else
                        e.setAttribute('data-target', '#' + id)
                }
            })
        },
        cardTab(selector = $('body')) {
            selector.find('[find-header]').each(function (i, cardBody) {
                const ulHead = $(cardBody).parent().find('.card-header ul.nav-tabs')[0]
                const tabHeads = $(ulHead).find(`[data-toggle="tab"]`)

                $(cardBody).children('.tab-content').children('.tab-pane').each(function (i, tabPane) {
                    const id = Utils.randomString(15)
                    if (i > tabHeads.length) return
                    tabHeads[i].setAttribute('href', `#${id}`)
                    tabPane.id = id
                })
            })
        },
        tableMobile(selector = $('body')) {
            selector.find('table.mobile').each(function (i, table) {
                //Đăt class cho table để append css
                const classId = Utils.randomString(15)
                if (table.getAttribute('cell-fix') != undefined) return
                $(table).addClass(classId).attr('cell-fix', '')
                const headersStyle = $(table).children('thead').children('tr')
                    .children('th:not(.auto-index-head):not(.select):not(.th-mobile):not(.th-action)')
                    .toArray()
                    .reduce((prev, th, index) => prev += `table.${classId} > tbody > tr > td .cell:not(.no-title)[index="${index + 1}"]::before{ content: '${th.getAttribute('mobile-head') || th.textContent}: ' }\n`, '')
                const styleElement = document.createElement('style')
                styleElement.innerHTML = headersStyle
                document.head.append(styleElement)

                table._onLoadTableBody(loadTable)
                table._onLoadTableBody(() => layoutAction.rebuild.autoBmd(table))
                table._onLoadTableBody(() => layoutAction.renders.collapse(table))
                loadTable.bind(table)()
            })
            function loadTable(this: HTMLTableElement) {
                $(this).children('tbody').children('tr').each(function (i, tr) {
                    if (tr._cellRender) return

                    const tds = $(tr).children('td:not([ai]):not([sl]):not(.td-mobile):not(.td-action)')
                    $(tr).find('.cell').each(function (i, cell) {
                        const index = cell.getAttribute('index') - 1
                        cell.innerHTML = (tds[index] && tds[index].innerHTML) || `<div class="text-danger">Not Found Cell Index ${index}</div>`
                        tr._cellRender = true
                    })
                })

            }
        },
        removeErrorInput(jElement = $('body')) {
            jElement.find('.form-group,.form-check').each(function (index, e) {
                if ($(this).find('.invalid-feedback')[0]) {
                    $(this).find('input').on('input', function _event() {
                        $(this).off('input', _event)
                        $(e).removeClass('has-danger').find('.invalid-feedback.default').remove()
                        $(e).find('.form-control-feedback.default').remove()
                    })
                }
            })
        }
    }
}

$(() => {
    Utils.activeAllActionFromObject(layoutAction.renders)
    layoutAction.getAllConfig()
    showAlert($('body'))
    Utils.activeAllActionFromObject(layoutAction.rebuild)
})

