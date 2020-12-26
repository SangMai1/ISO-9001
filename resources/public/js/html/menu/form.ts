//@ts-check
//@ts-ignore
function renderUlParentSelect(ulParent = $('[data-id="menu-parent-ul"]')) {
    if (!ulParent[0]) return
    const liMap = ulParent.children('li[data-parent][data-id]').toArray().reduce((pre, cur) => {
        pre[$(cur).data('id')] = {
            li: cur,
            isAddChild: false
        }
        return pre
    }, {})

    for (let liId in liMap) {
        const li = $(liMap[liId].li)
        const parentId = li.data('parent')
        const parentMap = liMap[parentId]
        if (!parentMap) continue

        const parent = $(parentMap.li)
        let parentUl
        if (!parentMap.isAddChild) {
            parentUl = $(`<ul class="btn btn-info btn-sm m-0 w-100 text-left collapse menu-id-${parentId}"></ul>`)
            parent.append(parentUl)
        } else {
            parentUl = parent.find('ul').eq(0)
        }

        parentUl.append(li)
    }
}
$(() => {
    renderUlParentSelect()
})