const Utils = {
    randomString(length = 10) {
        const characters = 'abcdefghijklmnopqrstuvwxyz';
        const charactersLength = characters.length;
        Utils.randomString = function () {
            let result = '';
            for (let i = 0; i < length; i++) {
                result += characters.charAt(Math.floor(Math.random() * charactersLength));
            }
            return result;
        };
        return Utils.randomString();
    },
    activeAllActionFromObject(obj, args) {
        for (let renderAction of Object.values(obj)) {
            if (renderAction instanceof Function)
                renderAction.apply(obj, args);
        }
    },
    loadScript(url) {
        const script = document.createElement('script');
        script.src = url;
        return new Promise((resolve) => {
            script.onload = function () { resolve(); script.remove(); };
            document.head.append(script);
        });
    },
    formToForm(form1, form2) {
        let childs1 = $(form1).find('input[name], textarea[name]');
        let childs2 = $(form2).find('input[name], textarea[name]');
        if (childs1.length !== childs2.length)
            return;
        for (let i = 0; i < childs1.length; ++i) {
            if (childs1[i].value)
                childs2[i].value = childs1[i].value;
            else if (childs1[i].checked)
                childs2[i].checked = childs1[i].checked;
        }
    }
};
