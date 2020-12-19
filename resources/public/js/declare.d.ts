interface HTMLElement {
    _eachSelected: (callback: (tr: HTMLTableCellElement) => void) => void
    _mapSelected: <K>(callback: (tr: HTMLTableCellElement) => K) => K[]
    _loadBodyTable: (body: any) => void
    _onLoadTableBody: (() => void)
}
interface FormData {
    fromObject: (obj: any) => void
}
interface JQuery<HTMLElement> {
    validateCustom: (config: any) => any
    _addSelectRows: (table: any) => void
    _autoIndexTable: (table: any) => void
}

interface Window {
    layoutAction: any,
    module: any
    getModule: (moduleName) => any
    token: string,
    Swal: Swal
    showLoading: (message) => Promise
}

interface Swal {
    "isValidParameter": Function
    "isUpdatableParameter": Function
    "isDeprecatedParameter": Function
    "argsToParams": Function
    "isVisible": Function
    "clickConfirm": Function
    "clickDeny": Function
    "clickCancel": Function
    "getContainer": Function
    "getPopup": Function
    "getTitle": Function
    "getContent": Function
    "getHtmlContainer": Function
    "getImage": Function
    "getIcon": Function
    "getIcons": Function
    "getInputLabel": Function
    "getCloseButton": Function
    "getActions": Function
    "getConfirmButton": Function
    "getDenyButton": Function
    "getCancelButton": Function
    "getLoader": Function
    "getHeader": Function
    "getFooter": Function
    "getTimerProgressBar": Function
    "getFocusableElements": Function
    "getValidationMessage": Function
    "isLoading": Function
    "fire": Function
    "mixin": Function
    "queue": Function
    "getQueueStep": Function
    "insertQueueStep": Function
    "deleteQueueStep": Function
    "showLoading": Function
    "enableLoading": Function
    "getTimerLeft": Function
    "stopTimer": Function
    "resumeTimer": Function
    "toggleTimer": Function
    "increaseTimer": Function
    "isTimerRunning": Function
    "bindClickHandler": Function
    "hideLoading": Function
    "disableLoading": Function
    "getInput": Function
    "close": Function
    "closePopup": Function
    "closeModal": Function
    "closeToast": Function
    "enableButtons": Function
    "disableButtons": Function
    "enableInput": Function
    "disableInput": Function
    "showValidationMessage": Function
    "resetValidationMessage": Function
    "getProgressSteps": Function
    "_main": Function
    "update": Function
    "_destroy": Function
    "DismissReason": any
    "version": any
    "default": Function
}