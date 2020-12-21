interface HTMLElement {
    _eachSelected: (callback: (tr: HTMLTableCellElement) => void) => void
    _mapSelected: <K>(callback: (tr: HTMLTableCellElement) => K) => K[]
    _loadBodyTable: (body: any) => void
    _onLoadTableBody: (evt: () => void) => void
}
interface FormData {
    fromObject: (obj: any) => FormData
}
interface JQuery<HTMLElement> {
    validateCustom: (config: any) => any
    _addSelectRows: (table: any) => void
    _autoIndexTable: (table: any) => void
}