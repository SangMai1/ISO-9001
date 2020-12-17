$(function () {
    (function () {
        const $searchDoc = $('#search-doc')
        $searchDoc.on('keydown', function () {
            const value = this.value

        })
    })()

    // ValidateCustom example
    var validator = $('#form-ex').validateCustom({
        rules: {
            first: {
                required: true,
                minlength: 5
            },
            second: {
                required: true
            },
            cb: {
                required: true
            }
        }
    });

    // TableComponent Example
    (function () {
        const getListBtn = $('#table-component-get-list-btn')
        const table = $('#table-component-table')
        getListBtn.on('click', function () {
            const result = []
            // Lấy ra DOM "tr" được chọn trong table (source trong file /resources/public/js/master-layout.ts => find "_eachSelected")
            table[0]._eachSelected(function (tr) {
                // Lấy data từ DOM tr -> data-id -> xem thêm về JQuery.fn.data -> https://viblo.asia/p/su-khac-nhau-giua-attr-va-data-trong-jquery-bJzKmzzEZ9N
                result.push($(tr).data('id'))
            })
            
            alert(`id của các table được chọn: ${JSON.stringify(result)}`);
        })
    })()
});