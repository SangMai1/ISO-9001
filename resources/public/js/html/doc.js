$(function () {
    (function(){
        const $searchDoc = $('#search-doc')
        $searchDoc.on('keydown', function(){
            const value = this.value
            
        })
    })()
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
});