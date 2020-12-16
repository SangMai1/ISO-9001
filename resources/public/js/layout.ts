//@ts-nocheck
// @ts-ignore
import { Utils } from "./utils"

const DATA_CONFIG_ATTRIBUTE = 'data-config'

export const layoutAction = {
    rebuild: {
        tooltip: () => $('[data-toggle="tooltip"]').tooltip().unbind('focusin'),
        popover: () => $('[data-toggle="popover"]').popover(),
        /**
         * Tự động thêm cột index cho table có attribute auto-index=true
        */
        autoIndexTable() {
            $('.table-responsive[auto-index="true"]').each((i, e) => {
                const table = $(e).removeAttr('auto-index').find('table')
                if (!table[0]) return
                table.find('thead > tr').prepend($('<th><strong>#</strong></th>'))
                table.find('tbody > tr').each((i, e) => $(e).prepend((`<td><em>${i + 1}</em></td>`)))
            })
        },
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
        collapse() {
            $('[data-toggle="collapse"]:not([href]):not([data-target])').each(function (i, e) {
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

window.layoutAction = layoutAction

$(() => {
    Utils.activeAllActionFromObject(layoutAction.renders)
    layoutAction.getAllConfig()
    Utils.activeAllActionFromObject(layoutAction.rebuild)

    // Thêm vào để gọi module từ require cho đơn giản
    window.module = window.require.s.contexts._.defined
    window.getModule = function (moduleName) {
        const moduleConfig = {
            utils: 'utils.Utils'
        }
        if (moduleConfig[moduleName]) return eval(`window.module.${moduleConfig[moduleName]}`)
        return window.module[module]
    }
})