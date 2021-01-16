{
  $(()=>{
    const form = $('[ajax-form]')
    let type = form.serializeArray().sohuu_type
    const soHuuTypesSelect = form.find('.sohuu-type')
    if(!soHuuTypesSelect) return
    const parentSelect = soHuuTypesSelect.parent()

    showSoHuu()

    const soHuuGroup = form.find('.icc:eq(0)')
    soHuuGroup.on('input', function(evt){
      showSoHuu(evt.target.value)
    })

    function showSoHuu(value = (new FormData(form[0])).get('sohuu_type')){
      soHuuTypesSelect.each(function(){
        const e = $(this)
        if(e.attr('i') != value) e.detach()
        else parentSelect.append(e)
      })
    }
  })
}