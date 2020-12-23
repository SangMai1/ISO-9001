$(() => {
    $('form[ajax-form]').validateCustom({
        rules: {
            ten: {
                required: true,
                minlength: 5
            },
            url: {
                required: true,
                minlength: 1
            },
            acs: {
                required: true,
                minlength: 1
            }
        }
    });
})