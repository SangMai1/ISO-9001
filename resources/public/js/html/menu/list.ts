//@ts-ignore
//@ts-nocheck
$(() => {
    let ulList = $('ul.icc')
    const formRegion = $('#form-region')
    const formRegionContent = formRegion.children('.content')


    const events = {
        addMenuButton(buttons = ulList.find('.add-menu-btn')) {
            buttons.on('click', function () {
                $.ajax({ url: urls.addMenuFormURL, method: 'GET' }).done((resp) => {
                    ulList.hide()
                    const id = $(this).closest('li').data('id') || ''
                    formRegion.data('parent-id', id).show()
                    formRegionContent.html($(resp))
                })

            })
        },
        editMenuButton(buttons = ulList.find('.edit-menu-btn')) {
            buttons.on('click', function () {
                const li = $(this).closest('li')
                const liParent = li.parent().closest('li')
                const id = li.data('id') || ''
                const parentId = liParent.data('id') || ''

                $.ajax({ url: urls.updateMenuFormURL, method: 'GET', data: `id=${id}` }).done((resp) => {
                    ulList.hide()
                    formRegion.data('parent-id', parentId).show()
                    formRegionContent.html($(resp))
                })

            })
        },
        movePosButton(buttons = ulList.find('.move-menu-btn')) {
            buttons.on('click', function () {
                // show Element
                ulList.addClass('move-mode') // radio

            })

        },
        deleteMenuButton(buttons = ulList.find('.delete-menu-btn')) {
            buttons.on('click', function () {
                const li = $(this).closest('li')
                const id = li.data('id') || ''
                $.ajax({
                    url: urls.deleteMenuURL,
                    data: (new FormData()).fromObject({ id: id })
                }).done((resp) => {
                    const message = getMessage(resp)
                    if (message.toLowerCase().match('success')) {
                        const parent = li.closest('ul:not(.icc)')
                        if (parent[0] && parent.children().length === 1) parent.removeClass('dropdown-toggle')
                        li.remove()
                    }
                });
            })
        }
    }

    Utils.activeAllActionFromObject(events)
    reRenderUlParentSelect()

    // event form append
    {
        formRegion.find('.go-back-btn:eq(0)').on('click', function () {
            ulList.show()
            formRegion.hide()
            if (window.nextReload) reloadPage()
        })
    }

    // event cập nhật vị trí
    {
        const regionUpdatePos = $('#update-position-region')
        const input = regionUpdatePos.find('input')
        const updateBtn = regionUpdatePos.find('.update-btn')
        updateBtn.on('click', function () {
            const idUpdate = regionUpdatePos.data('id')
            const parentId = $('body').find('input[type="radio][name="position"]:checked').val()
            if (!idUpdate) return
            if (idUpdate == parentId) return Swal.fire({ ..._swagConfig.errorAjax, title: 'Lỗi ID trùng với chính ID cha ?' })
            $.ajax({ url: urls.updateMenuFormURL, data: (new FormData).fromObject({ id: idUpdate, idCha: parentId }) })
                .then(() => {
                    // reloadPage()
                    // regionUpdatePos.addClass()
                })
        })
    }


    //--------------------------------------------------------------------------------------------------------------//
    function reloadPage() {
        $.ajax({ url: urls.listMenuURL, method: 'GET' }).done((resp) => {
            window.nextReload = false
            ulList.replaceWith($(resp).find('ul.icc'))
            ulList = $('ul.icc')
            Utils.activeAllActionFromObject(events)
            layoutAction.renders.renderMenu('ul.icc')
            reRenderUlParentSelect()
        })
    }

    function reRenderUlParentSelect() {
        $('.icc li:not(.root) a').each((i, e) => {
            e.href = '.' + e.getAttribute('href').replace('id', 'idc').substring(1)
        })
        $('.icc ul').each((i, e) => {
            $(e).addClass(e.id.replace('id', 'idc')).removeAttr('id')
        })
    }
})