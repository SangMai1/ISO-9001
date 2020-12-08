export const Utils = {
    rebuildTooltip() {
        $(() => {
            $('[data-toggle="tooltip"]').tooltip()
            $('[data-toggle="popover"]').popover()
        })
    },
    showMessage(message = 'no message'){
        console.log(message)
    }
}