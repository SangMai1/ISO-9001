$(()=>{
  const table = $('#main-list')
  if(!table[0]) return
  $('#delete-btn').on('click', function(){
    table[0]._eachSelected(function(tr){
      console.log($(tr).data('id'))
    })
  })
})