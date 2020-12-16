define(["require", "exports"], function (require, exports) {
    "use strict";
    Object.defineProperty(exports, "__esModule", { value: true });
    exports.Utils = void 0;
    exports.Utils = {
        showMessage(message = 'no message') {
            console.log(message);
        },
        randomString(length = 10) {
            const characters = 'abcdefghijklmnopqrstuvwxyz';
            const charactersLength = characters.length;
            exports.Utils.randomString = function () {
                let result = '';
                let charactersLength = characters.length;
                for (let i = 0; i < length; i++) {
                    result += characters.charAt(Math.floor(Math.random() * charactersLength));
                }
                return result;
            };
            return exports.Utils.randomString();
        },
        activeAllActionFromObject(obj) {
            for (let renderAction of Object.values(obj)) {
                if (renderAction instanceof Function)
                    renderAction();
            }
        },
        loadScript(url) {
            const script = document.createElement('script');
            script.src = url;
            return new Promise((resolve) => {
                script.onload = resolve;
                document.head.append(script);
            });
        }
    };
});
