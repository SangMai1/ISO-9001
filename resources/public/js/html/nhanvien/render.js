$(() => {
  $('form[ajax-form]').validateCustom({
    rules: {
      ten: {
        required: true,
        minlength: 1
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
  $('#phongban').autocomplete();
  $('#chucdanh').autocomplete();
})
