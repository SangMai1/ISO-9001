declare const Utils: {
    randomString(length?: number): string;
    activeAllActionFromObject(obj: any, args: any): void;
    loadScript(url: any): Promise<void>;
    formToForm(form1: any, form2: any): void;
};
