$(() => {
    $(".viewForm").hide();
    $('#ids').val();
    $('.viewFind').on('click', function () {
        if ($(".viewForm").is(":hidden")) {
            $(".viewForm").show();
        }
        else {
            $(".viewForm").hide();
        }
    });
    $('.buttonDelete').on('click', function (event) {
        event.preventDefault();
        const table = $('#table');
        if (!table[0])
            return;
        var ids = [];
        var i = 0;
        table[0]._eachSelected(function (tr) {
            ids[i] = $(tr).data('id');
            i++;
        });
        $('#ids').val(ids);
        $('#myDelete').modal();
        $('#delRef').on('click', function () {
            $('#formDelete').submit();
        });
    });
});
