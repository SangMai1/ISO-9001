
function renderUlParentSelect() {
    $('.icc a').each((i, e)=>{
        e.href = e.getAttribute('href').replace('id', 'idc')
    })
    $('.icc ul').each((i, e)=>{
        console.log(e.id, e.id.replace('id', 'idc'))
        e.id = e.id.replace('id', 'idc')
    })
}
$(() => {
    renderUlParentSelect()
})