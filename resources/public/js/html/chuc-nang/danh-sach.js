$(() => {
    const table = $('.table-region table')
    const deleteHref = table.attr('delete-href')
    table.find('tbody > tr > td.td-action > .delete-btn').on('click', function (evt) {
        const tr = $(this).closest('tr')
        const id = tr.data('id')
        $.ajax({ url: deleteHref, data: (new FormData()).fromObject({ id: id, _token: token }) })
            .done(() => tr.remove())
    })
})