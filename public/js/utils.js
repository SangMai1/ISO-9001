define(["require", "exports"], function (require, exports) {
    "use strict";
    Object.defineProperty(exports, "__esModule", { value: true });
    exports.Utils = void 0;
    exports.Utils = {
        rebuildTooltip() {
            $(() => {
                $('[data-toggle="tooltip"]').tooltip();
                $('[data-toggle="popover"]').popover();
            });
        },
        showMessage(message = 'no message') {
            console.log(message);
        },
        rebuildPagination() {
            $('.pagination').each((i, e) => {
                const [ page, limit, offset]
            })
        },

        /**
         * 
         * @param {*} attributes 
         * @param {HTMLElement} element
         */
        getHTMLAttributes(attributes = [], element) {
            !(attributes instanceof Array) && (attributes = [])
            return attributes.map((attr) => element.getAttribute(attr))
        }
    };
});
