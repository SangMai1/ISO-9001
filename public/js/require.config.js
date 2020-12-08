"use strict";
window.module = require.s.contexts._.defined;
window.getModule = function (moduleName) {
    const moduleConfig = {
        utils: 'utils.Utils'
    };
    if (moduleConfig[moduleName])
        return eval(`window.module.${moduleConfig[moduleName]}`);
    return window.module[module];
};
