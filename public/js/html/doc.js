$(function () {
    (function () {
        const $searchDoc = $('#search-doc');
        $searchDoc.on('keydown', function () {
            const value = this.value;
        });
    })();
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
    (function () {
        const getListBtn = $('#table-component-get-list-btn');
        const table = $('#table-component-table');
        getListBtn.on('click', function () {
            const result = [];
            table[0]._eachSelected(function (tr) {
                result.push($(tr).data('id'));
            });
            alert(`id của các table được chọn: ${JSON.stringify(result)}`);
        });
    })();
});
