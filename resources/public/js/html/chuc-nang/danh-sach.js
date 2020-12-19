// $(() => {
//     const table = $('#table-main');
//     let token = $('.csrf-token > input').val();
//     const deleteBtn = $('#delete-btn');
//     const deleteHref = deleteBtn.data('href');
//     if (!table[0]) return
//     deleteBtn.on('click', function () {
//         const idsSelected = table[0]._mapSelected(tr => $(tr).data('id'));

//         $.ajax({
//             method: "POST",
//             url: deleteHref,
//             data: new FormData().fromObject({ ids: idsSelected, _token: token }),
//         }).done(function (resp) {
//             table[0]._loadBodyTable($('tbody > tr', $(resp)))
//         })
//     });
// });
