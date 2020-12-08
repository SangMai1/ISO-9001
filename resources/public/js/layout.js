window.module = require.s.contexts._.defined

window.getModule = function (moduleName) {
    const moduleConfig = {
        utils: 'utils.Utils'
    }
    if (moduleConfig[moduleName]) return eval(`window.module.${moduleConfig[moduleName]}`)
    return window.module[module]
}

const layoutAction = {
    rebuildAll() {
        $('[data-toggle="tooltip"]').tooltip().unbind('focusin')
        $('[data-toggle="popover"]').popover()
        $('[data-toggle="collapse"]:not([href])').click(function () {
            const next = $(this).next()
            this.setAttribute('aria-expanded', !next.hasClass('show'))
            next.collapse('toggle')
        })
    },
    /**
     * Kích hoạt menu bên của sidebar
     * @param {string| {href: string}} menu 
     */
    activeMenu(menu) {
        const navBar = $('.nav')
        layoutAction.activeMenu = function (menu) {
            navBar.find('.active').each((i, e)=>{
                $(e).removeClass('active')
            })
            const activeTag = menu instanceof Object && menu.href
                ? navBar.find(`[href=${menu.href}]`)
                : navBar.find(`li [active="${menu}"]`)
            if (!activeTag[0]) return
            activeTag.closest('.nav-item').addClass('active')
            let closestUlTag = activeTag

            while (true) {
                closestUlTag = closestUlTag.parent().closest('ul')
                if (closestUlTag[0] === navBar[0] || !closestUlTag[0]) break
                !closestUlTag.hasClass('show') && closestUlTag.closest('li').find('.nav-link')[0].click()
            }

            setTimeout(()=>{})
        }
        layoutAction.activeMenu(menu)
    }
}


$(() => {
    layoutAction.rebuildAll()
})