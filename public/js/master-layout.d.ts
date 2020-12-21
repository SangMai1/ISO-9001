declare const _swalConfig: {
    [key: string]: SweetAlertOptions;
};
declare const Toast: SwalInterface;
declare const showLoading: (message?: string) => void;
declare const showAlert: (html: JQuery<HTMLElement>) => Promise<SweetAlertResult<any>>;
