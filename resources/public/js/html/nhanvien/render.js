function render(){
    $.ajax({
      method:"post",
      url : '/nhan-vien/render' ,
      data : {
        action : 'render',
        ten : $('#ten').val(),
      },
      dataType:"json",
      success : function(data){
        alert(data);
      },
    });
  }