$(()=>{
    $(".viewForm").hide();
    $('#ids').val();
    $('.viewFind').on('click', function() {	
        if ($(".viewForm").is(":hidden")) {
            $(".viewForm").show();
        }else{
            $(".viewForm").hide();
        }
    });

});