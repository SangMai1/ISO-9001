interface HTMLElement {
    _eachSelected: (callback: (tr: HTMLTableCellElement) => void) => void
    _mapSelected: <K>(callback: (tr: HTMLTableCellElement) => K) => K[]
    _loadBodyTable: (body: any) => void
    _appendBodyTable: (body: any) => void
    _onLoadTableBody: (evt: (table: HTMLTableElement, body: HTMLTableRowElement[]) => void) => void
    _setBmdError: (message: string) => void
    _setLoadMore: (config: loadMoreConfig) => void
    _setLoadMore: (config: (config: loadMoreConfig) => loadMoreConfig) => void
}

interface FormData {
    fromObject: (obj: any) => FormData
}

interface JQuery<HTMLElement> {
    validateCustom: (config: any) => any
    _addSelectRows: (table: any) => void
    _autoIndexTable: (table: any) => void
}

type loadMoreConfig = { urlAjax?: string, limit?: number, offset?: number, tableQuery?: string, isLoadNow?: boolean }