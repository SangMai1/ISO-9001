//@ts-ignore
//@ts-nocheck
$(() => {
    let ulList = $('ul.icc')
    const formRegion = $('#form-region')
    const formRegionContent = formRegion.children('.content')
    const regionUpdatePos = $('#update-position-region')
    const formUpdatePos = regionUpdatePos.find('form')
    const posUpdate = formUpdatePos.find('input[name="vitri"]')

    let liUpdate = null

    const events = {
        addMenuButton(buttons = ulList.find('.add-menu-btn')) {
            buttons.on('click', function () {
                $.ajax({ url: urls.addMenuFormURL, method: 'GET' }).done((resp) => {
                    regionUpdatePos.hide()
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
                    regionUpdatePos.hide()
                    formRegion.data('parent-id', parentId).show()
                    formRegionContent.html($(resp))
                })

            })
        },
        movePosButton(buttons = ulList.find('.move-menu-btn')) {
            buttons.on('click', function () {
                // show Element
                regionUpdatePos.addClass('move-mode') // radio
                const li = liUpdate = $(this).closest('li')
                const parentLi = li.parent().closest('li')
                regionUpdatePos.data('id', li.data('id'))

                if (!parentLi[0]) ulList.find('.menu-item.root input[type="radio"]:eq(0)')[0].checked = true
                else parentLi.find('input[type="radio"]:eq(0)')[0].checked = true

                liUpdate.find('a:eq(0)').removeClass('btn-primary').addClass('btn-primary')  
                formUpdatePos.find('input[name="id"]:eq(0)').val(li.data('id'))
                posUpdate.val('')
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
    renderMenu()

    // event form append
    {
        formRegion.find('.go-back-btn:eq(0)').on('click', function () {
            regionUpdatePos.show()
            formRegion.hide()
            if (window.nextReload) reloadPage()
        })
    }

    // event cập nhật vị trí
    {
        const cancelBtn = regionUpdatePos.find('.cancel-btn:eq(0)')

        formUpdatePos.validateCustom({
            rules: {
                vitri: { required: true }
            }
        })

        cancelBtn.on('click', function () {
            regionUpdatePos.removeClass('move-mode')
            liUpdate.find('a:eq(0)').removeClass('btn-primary').addClass('btn-primary')
        })

        window.updatePosAction = (resp) => {
            regionUpdatePos.removeClass('move-mode')
            reloadPage(resp)
        }

    }


    //--------------------------------------------------------------------------------------------------------------//
    async function reloadPage(resp) {
        resp = resp || await $.ajax({ url: urls.listMenuURL, method: 'GET' })
        window.nextReload = false
        ulList.replaceWith($(resp).find('ul.icc'))
        ulList = $('ul.icc')
        Utils.activeAllActionFromObject(events)
        renderMenu('ul.icc')
        renderMenu()
    }

    function renderMenu(ulQuery = '[data-id="menu-parent-ul"]') {
        $(ulQuery).each((i, ul) => {
            ul = $(ul)
            ul.removeClass('d-none')
            let { liMap, arrPos } = ul
                .children("li[data-parent][data-id]")
                .toArray()
                .reduce((pre, cur, index) => {
                    const icon = $(cur).find('.icon-menu')
                    const id = $(cur).data("id")
                    let iconAdd = $(icon.text())
                    iconAdd.find('script').remove()
                    iconAdd = iconAdd.filter((i, e) => {
                        if (e.tagName === "SCRIPT") return false
                        return true
                    })
                    icon.html(iconAdd);
                    pre.liMap[$(cur).data("id")] = {
                        li: cur,
                        isAddChild: false
                    };
                    pre.arrPos[index] = [id, Number.parseInt($(cur).attr('position')) || 0]
                    return pre;
                }, { liMap: {}, arrPos: [] });

            arrPos = arrPos.sort((a, b) => a[1] - b[1])
            for (let [liId] of arrPos) {
                const li = $(liMap[liId].li);
                li.detach()
                ul.append(li)
                const parentId = li.data("parent");
                const parentMap = liMap[parentId];

                if (!parentMap || parentMap.li === li[0]) continue;

                const parent = $(parentMap.li);
                let parentUl;
                if (!parentMap.isAddChild) {
                    parentUl = $(
                        `<ul class="text-left collapse p-0" id="menu-idc-${parentId}"></ul>`
                    );
                    const btnCollapse = $(parent)
                        .find("a").eq(0)
                        .attr("data-toggle", 'collapse')
                        .addClass("dropdown-toggle")
                        .addClass("auto-icon");
                    btnCollapse.attr("href", `#menu-idc-${parentId}`);
                    parent.append(parentUl);
                    parentMap.isAddChild = true
                } else {
                    parentUl = parent.find("ul").eq(0);
                }
                parentUl.append(li);
            }

        });
    }
})