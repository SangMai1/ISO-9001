declare const DATA_CONFIG_ATTRIBUTE = "data-config";
declare const layoutAction: {
    rebuild: {
        tooltip: (selector?: JQuery<HTMLElement, HTMLElement>) => any;
        popover: (selector?: JQuery<HTMLElement, HTMLElement>) => any;
        autoBmd(selector: any): void;
        autoFormEvent(selector?: JQuery<HTMLElement, HTMLElement>): void;
        autoAddDeleteEventTable(selector?: JQuery<HTMLElement, HTMLElement>): void;
        autoAddSelectColumn(selector?: JQuery<HTMLElement, HTMLElement>): void;
        autoIndexTable(selector?: JQuery<HTMLElement, HTMLElement>): void;
        activeFromMenuTag(): void;
    };
    activeMenu(menu: string | {
        href: string;
    }): void;
    getAllConfig(): void;
    readConfig(selector: any): any;
    renders: {
        collapse(selector?: JQuery<HTMLElement, HTMLElement>): void;
        cardTab(selector?: JQuery<HTMLElement, HTMLElement>): void;
        tableMobile(selector?: JQuery<HTMLElement, HTMLElement>): void;
        removeErrorInput(jElement?: JQuery<HTMLElement, HTMLElement>): void;
    };
};
