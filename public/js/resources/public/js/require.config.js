(function () {
    const requireLib = {};
    window.requirejs.config({
        appDir: ".",
        baseUrl: "js",
        paths: Object.assign({}, requireLib),
    });
    require(Object.keys(requireLib));
})();
