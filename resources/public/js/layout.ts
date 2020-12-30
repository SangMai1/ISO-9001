//@ts-nocheck
// @ts-ignore
const DATA_CONFIG_ATTRIBUTE = "data-config";
$('ac').auto
const layoutAction = {
    rebuild: {
        tooltip: (selector = $("body")) => selector.find('[data-toggle="tooltip"]').tooltip(),
        popover: (selector = $("body")) => selector.find('[data-toggle="popover"]').popover(),
        autoBmd(selector = $("body")) {
            if ((selector = $(selector))[0]) {
                selector.find(".btn").bmdRipples();
                selector.find(".form-control").bmdText();
                selector.find(".selectpicker").selectpicker();
            }
        },
        autoFormEvent(selector = $("body")) {
            selector.find("form[ajax-form]").on("submit", function (evt) {
                evt.preventDefault();
                let callback = window[$(this).attr('ajax-form')]
                if (!(callback instanceof Function)) callback = () => { }
                if (!$(this).valid()) return;
                const postHref = this.getAttribute("action");
                $.ajax({
                    url: postHref,
                    data: new FormData(this),
                    error: resp => {
                        Swal.close();
                        if (resp.getResponseHeader("content-type").toLowerCase() !== "application/json") return $.ajaxSettings.error();
                        const result = JSON.parse(resp.responseText);
                        if (result.message !== "The given data was invalid.")
                            return Swal.fire({ ..._swagConfig.toast, title: result.message, icon: 'error' });
                        for (let [fieldName, error] of Object.entries(result.errors)) {
                            const input = $(this).find(`[name="${fieldName}"]`);
                            if (input[0]) input[0]._setBmdError(error);
                        }
                        layoutAction.renders.removeErrorInput($(this));
                    }
                }).done(callback);
            });
        },
        /**
         * Tự động thêm event xóa cho table có attribute [delete-href]
         *      -> event được gán lên query 'tbody > tr > td.td-action .delete-btn'
         *      -> id được gắn trong attribute data-id của <tr> trong <tbody> của <table>
         */
        autoAddDeleteEventTable(selector = $("body")) {
            selector
                .find("table[delete-href]")
                .each(function (i, table: JQuery<HTMLElement>) {
                    table = $(table);
                    const deleteHref = table.attr("delete-href");

                    const setEvent = body => {
                        body.find("td.td-action .delete-btn").on(
                            "click",
                            function (evt) {
                                const tr = $(this).closest("tr");
                                const id = tr.data("id");
                                $.ajax({
                                    url: deleteHref,
                                    data: new FormData().fromObject({
                                        id: id,
                                        _token: token
                                    })
                                }).done(() => {
                                    tr.remove();
                                    if (table[0]._isLoadMore)
                                        table[0]._setLoadMore(config => ({
                                            offset: config.offset - 1
                                        }));
                                    if (
                                        table.find(
                                            "thead > tr > .auto-index-head"
                                        )[0]
                                    )
                                        table._autoIndexTable();
                                });
                            }
                        );
                    };

                    table[0]._onLoadTableBody((table, body) =>
                        setEvent($(body))
                    );
                    setEvent(table.find("tbody > tr"));
                });
        },
        /**
         * Tự động thêm cột select cho table
         */
        autoAddSelectColumn(selector = $("body")) {
            selector.find("table[select]").each(function (index, table) {
                const callbackName = table.getAttribute("select");
                if (callbackName) $(table)._addSelectRows(window[callbackName]);
                else $(table)
                    ._addSelectRows()
                    .removeClass("select");
            });
        },
        /**
         * Tự động thêm cột index cho table có attribute auto-index
         */
        autoIndexTable(selector = $("body")) {
            selector
                .find("table[auto-index]")
                ._autoIndexTable()
                .removeClass("auto-index");
        },
        /**
         * Auto kích hoạt menu thừ thẻ active menu @activeMenuTag snippet
         */
        activeFromMenuTag() {
            const activeMenuTag = $("#active-menu");
            if (!activeMenuTag) return;
            let config = activeMenuTag.attr("active")
            layoutAction.activeMenu(
                config || { href: window.location.pathname }
            );
        }
    },
    /**
     *
     * @param menu string | jquery selector
     */
    activeMenu(menu: string | { href: string }) {
        const navBar = $(".nav:not(.navbar-nav)");
        layoutAction.activeMenu = function (menu) {
            navBar.find(".active").removeClass("active");
            const activeTag =
                menu instanceof Object && menu.href
                    ? navBar.find(`[href="${menu.href}"]`)
                    : navBar.find(`li [active="${menu}"]`);
            if (!activeTag[0]) return;
            activeTag.closest(".nav-item").addClass("active");
            let closestUlTag = activeTag;

            while (true) {
                closestUlTag = closestUlTag.parent().closest("ul");
                if (closestUlTag[0] === navBar[0] || !closestUlTag[0]) break;
                closestUlTag.collapse("show");
            }
        };
        layoutAction.activeMenu(menu);
    },
    /**
     * Đọc tất config từ html tag config và chuyển html trong tag đó thành thành obj javascript => sử dụng eval
     */
    getAllConfig() {
        const config = {};
        $("config").each((i, e) => {
            const configTag = $(e);
            const configForTag = $(configTag.attr("href") || configTag.prev());
            if (configForTag[0]) {
                try {
                    const key = Utils.randomString(15);
                    config[key] = eval(configTag.html());
                    configForTag.attr(DATA_CONFIG_ATTRIBUTE, key);
                } catch (error) { }
            }
            configTag.remove();
        });
        window.$config = config;
    },
    /**
     * Đọc config từ html element
     * @param selector selector jquery
     */
    readConfig(selector) {
        return window.$config[$(selector).attr(DATA_CONFIG_ATTRIBUTE)] || {};
    },
    renders: {
        renderMenu(ulQuery = '[data-id="menu-parent-ul"]') {
            $(ulQuery).each((i, ul) => {
                ul = $(ul)
                ul.removeClass('d-none')
                let { liMap, arrPos } = ul
                    .children("li[data-parent][data-id]")
                    .toArray()
                    .reduce((pre, cur, index) => {
                        const icon = $(cur).find('.icon-menu')
                        const id = $(cur).data("id")
                        let iconAdd = $(icon.text())
                        iconAdd.find('script').remove()
                        iconAdd = iconAdd.filter((i, e) => {
                            if (e.tagName === "SCRIPT") return false
                            return true
                        })
                        icon.html(iconAdd);
                        pre.liMap[$(cur).data("id")] = {
                            li: cur,
                            isAddChild: false
                        };
                        pre.arrPos[index] = [id, Number.parseInt($(cur).attr('position')) || 0]
                        return pre;
                    }, { liMap: {}, arrPos: [] });

                arrPos = arrPos.sort((a, b) => a[1] - b[1])
                for (let [liId] of arrPos) {
                    const li = $(liMap[liId].li);
                    li.detach()
                    ul.append(li)
                    const parentId = li.data("parent");
                    const parentMap = liMap[parentId];

                    if (!parentMap || parentMap.li === li[0]) continue;
                    
                    const parent = $(parentMap.li);
                    let parentUl;
                    if (!parentMap.isAddChild) {
                        parentUl = $(
                            `<ul class="text-left collapse p-0" id="menu-id-${parentId}"></ul>`
                        );
                        const btnCollapse = $(parent)
                            .find("a").eq(0)
                            .attr("data-toggle", 'collapse')
                            .addClass("dropdown-toggle")
                            .addClass("auto-icon");
                        btnCollapse.attr("href", `#menu-id-${parentId}`);
                        parent.append(parentUl);
                        parentMap.isAddChild = true
                    } else {
                        parentUl = parent.find("ul").eq(0);
                    }
                    parentUl.append(li);
                }
                
            });
        },
        collapse(selector = $("body")) {
            $(selector)
                .find('[data-toggle="collapse"]:not([href]):not([data-target])')
                .each(function (i, e) {
                    const id = Utils.randomString(15);
                    const collapse = $(e).next(".collapse");
                    if (collapse[0]) {
                        collapse.attr("id", id);
                        if (e.tagName === "A") e.href = "#" + id;
                        else e.setAttribute("data-target", "#" + id);
                    }
                });
        },
        cardTab(selector = $("body")) {
            selector.find("[find-header]").each(function (i, cardBody) {
                const ulHead = $(cardBody)
                    .parent()
                    .find(".card-header ul.nav-tabs")[0];
                const tabHeads = $(ulHead).find(`[data-toggle="tab"]`);

                $(cardBody)
                    .children(".tab-content")
                    .children(".tab-pane")
                    .each(function (i, tabPane) {
                        const id = Utils.randomString(15);
                        if (i > tabHeads.length) return;
                        tabHeads[i].setAttribute("href", `#${id}`);
                        tabPane.id = id;
                    });
            });
        },
        tableMobile(selector = $("body")) {
            selector.find("table.mobile").each(function (i, table) {
                //Đăt class cho table để append css
                const classId = Utils.randomString(15);
                if (table.getAttribute("cell-fix") != undefined) return;
                $(table)
                    .addClass(classId)
                    .attr("cell-fix", "");
                const headersStyle = $(table)
                    .children("thead")
                    .children("tr")
                    .children(
                        "th:not(.auto-index-head):not(.select):not(.th-mobile):not(.th-action)"
                    )
                    .toArray()
                    .reduce(
                        (prev, th, index) =>
                        (prev += `table.${classId} > tbody > tr > td .cell:not(.no-title)[index="${index +
                            1}"]::before{ content: '${th.getAttribute(
                                "mobile-head"
                            ) || th.textContent}: ' }\n`),
                        ""
                    );
                const styleElement = document.createElement("style");
                styleElement.innerHTML = headersStyle;
                document.head.append(styleElement);

                table._onLoadTableBody(loadTable.bind(table));
                table._onLoadTableBody(() =>
                    layoutAction.rebuild.autoBmd(table)
                );
                table._onLoadTableBody(() =>
                    layoutAction.renders.collapse(table)
                );
                loadTable.bind(table)();
            });
            function loadTable(this: HTMLTableElement) {
                $(this)
                    .children("tbody")
                    .children("tr")
                    .each(function (i, tr) {
                        console.log("load table");
                        if (tr._cellRender) return;

                        const tds = $(tr).children(
                            "td:not([ai]):not([sl]):not(.td-mobile):not(.td-action)"
                        );
                        $(tr)
                            .find(".cell")
                            .each(function (i, cell) {
                                const index = cell.getAttribute("index") - 1;
                                cell.innerHTML =
                                    (tds[index] && tds[index].innerHTML) ||
                                    $(cell).addClass("d-none");
                                tr._cellRender = true;
                            });
                    });
            }
        },
        removeErrorInput(jElement = $("body")) {
            jElement.find(".form-group,.form-check").each(function (index, e) {
                if ($(this).find(".invalid-feedback")[0]) {
                    $(this)
                        .find("input")
                        .on("input", function _event() {
                            $(this).off("input", _event);
                            this._setBmdError(-1);
                        });
                }
            });
        },
        addLoadMore(jElement = $("body")) {
            jElement.find("table[load-more]").each(function (index, table) {
                const config = {};
                const limit = table.getAttribute("load-more-limit");
                if (limit) config.limit = limit;
                table._setLoadMore(config);
            });
        },
        autoCompleteSelect(listJSelect = $('body').find('select[autocomplete]')){
            listJSelect.each(function(i, select: JQuery<HTMLElement>){
                select =$(select)
                let config = select.attr('autocomplete')
                if(config && (config = window[config]) && typeof config === 'function') config = config()
                if (typeof config !== 'object') config = undefined
                $(select).autoCompleteSelect(config)
            })
        }
    }
};

$(() => {
    Utils.activeAllActionFromObject(layoutAction.renders);
    layoutAction.getAllConfig();
    showAlert($("body"));
    Utils.activeAllActionFromObject(layoutAction.rebuild);
});
