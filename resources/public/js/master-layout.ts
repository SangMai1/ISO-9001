// @ts-ignore
//@ts-nocheck
HTMLElement.prototype.on = HTMLElement.prototype.addEventListener
moment.locale('vn')
const global = {}

$(() => { window.token = $('meta[name="csrf-token"]').attr("content") })

$.fn.perfectScrollbar = function (this) { return this }
$.fn.findAll = function (this: JQuery<HTMLElement>, query) {
    arr = []
    for (let e of this) {
        e = $(e)
        if (e.is(query))
            arr = arr.concat([e[0], ...e.find(query)])
        else
            arr.push(e.find(query))
    }
    return $(arr)
}

const _swagConfig: { [key: string]: SweetAlertOptions } = {};
var Toast: SwalInterface;
const showLoading = function (message = "Chờ xí ...") {
    Toast.fire({
        title: message,
        showCloseButton: false,
        didOpen: () => Swal.showLoading()
    });
};
const getMessage = (html) => (html = $(html)).hasClass("alert-message") ? html.text() : $(".alert-message", html).text()

const showAlert = function (html: JQuery<HTMLElement>) {
    html = $(html);
    let message = getMessage(html);
    const _typeAlert = _swagConfig[message];
    if (_typeAlert) return Swal.fire(_typeAlert);
    else if (message)
        try {
            message = eval(`(()=>(${message}))()`);
            if (typeof message === "object")
                return Swal.fire({
                    ...(_swagConfig[message._type] || _swagConfig.toast),
                    ...message
                });
        } catch (error) {
            console.log(message);
        }

    Swal.close();
};

(function () {
    addJqueryValidationCustom()
    addJqueryTableAutoIndex()
    addSelectModeTable()
    addHTMLTableElementPrototype()
    addPrototypeFormData()
    fixTooltip()
    configSweetAlert()
    $(fixMaterial)
    $(renderNotification)

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        },
        processData: false,
        mimeType: "multipart/form-data",
        contentType: false,
        method: "POST",
        beforeSend: () => showLoading(),
        success: resp => showAlert(resp),
        error: (resp) => {
            if (resp.getResponseHeader("content-type").toLowerCase() === "application/json") {
                const result = JSON.parse(resp.responseText);
                return Swal.fire({ ..._swagConfig.toast, title: result.message, icon: 'error' });
            }
            Swal.fire(_swagConfig.errorAjax)
        }
    });

    function renderNotification() {
        addNotificationPusher()
        const notificationLi = $('#notifications-li')
        const dropdownMenu = notificationLi.find('.dropdown-menu')

        const readDiv = $('<div class="read"></div>')
        const unreadDiv = $('<div class="unread"></div>')
        dropdownMenu
            .append($('<div class="mx-2 mb-0 mt-2">Chưa đọc</div>'))
            .append(unreadDiv)
            .append($('<div class="mx-2 my-0">Đã đọc</div>'))
            .append(readDiv)

        let quantityUnread = 0
        let userIds = []

        if (_notifications.read.length)
            _notifications.read.forEach((notification) => { renderChild(readDiv, notification) })
        else
            readDiv.prev().hide()

        if (_notifications.unread.length)
            _notifications.unread.forEach((notification) => { renderChild(unreadDiv, notification); ++quantityUnread })
        else
            unreadDiv.prev().hide()

        let isPreventShowNotification = false;
        let lastNotificationUnreadId = getLastNotificationId(_notifications.unread)

        global['_notification_event'] = function () {
            $('[id="notifications-li"]').each(function () {
                const e = $(this)
                if (e.data('has-event-notification')) return
                e.data('has-event-notification', true)
                e.on('show.bs.dropdown', function (evt) {
                    if (isPreventShowNotification || !lastNotificationUnreadId) return
                    console.log('clear notification')
                    const noLi = $('[id="notifications-li"]')
                    $.getJSON({ url: `${requestPath.u.notification.readNotification}?id=${lastNotificationUnreadId}`, success: null, error: null, beforeSend: null })
                        .done((resp) => { $('.notification').empty(), isPreventShowNotification = true })
                        .fail(() => isPreventShowNotification = false)
                })
            })
        }

        renderUserCss(userIds)
        notificationLi.prepend($(`<script>global['_notification_event']()</script>`)[0])
        quantityUnread && notificationLi.find('.notification:eq(0)').html(quantityUnread)

        function renderChild(parentDiv, notification, method = 'append') {
            switch (notification.type) {
                case 'text':
                    {
                        parentDiv[method]($(`<div class="dropdown-item">${notification.data}</div>`))
                    }
                    break
                case 'text-from':
                    {
                        userIds.push(notification.data.user)
                        parentDiv[method]($(
                            `<div class="dropdown-item">
                                <div>
                                    <span class="nv" i="${notification.data.user}"></span>
                                    <span>&nbsp<strong>${notification.data.action || 'đã để lại lời nhắn'}</strong>: ${notification.data.message}</span>
                                    <div>${moment(notification.created_at).calendar()}</div>
                                <div>
                            </div>`))
                    }
            }
        }
        function getLastNotificationId(arr) {
            return arr.reduce((max, { created_at, id }) => {
                let time = (new Date(created_at)).getTime()
                return time > max.time ? { id: id, time: time } : max
            }, { time: 0 }).id
        }
        function addNotificationPusher() {
            let pusher = new Pusher(config.keyPusher, {
                encrypted: false,
                cluster: "ap1"
            });

            let channel = pusher.subscribe('notification');
            channel.bind('user-id-' + _user.id, evt);
            channel.bind('all', console.log);

            function evt(data) {
                if (data.users && (data.users.indexOf(_user.id) === -1)) return
                $.getJSON({
                    url: `${requestPath.u.notification.getNotificationsUnread}?id=${data.notification || 0}`,
                    success: null,
                    error: null,
                    beforeSend: null
                }).done((notification) => {
                    renderChild($('.unread'), notification, 'prepend')
                    $('.unread').prev().show()
                    isPreventShowNotification = false
                    lastNotificationUnreadId = data.notification
                    $('.notification').each(function () { $(this).html((Number($(this).html()) || 0) + 1) })
                })
            }
        }
    }

    function renderUserCss(userIds: any[]) {
        const style = $('<style id="nv-style"></style>')
        document.head.append(style[0])
        const map = {}
        renderUserCss = function (userIds: any[]) {
            userIds = userIds.filter((cur) => {
                if (map[cur]) return false
                return (map[cur] = true)
            })
            if (!userIds.length) return
            const path = `${requestPath.u.nhanvien.info}?type=more.min.json${Array.from(new Set(userIds)).reduce((acc, cur) => `${acc}&ids[]=${cur}`, '')}`
            $.getJSON({ url: path, success: null, error: null })
                .done((users: any[]) => {
                    for (let id in users) {
                        style.append(`.nv[i="${id}"]::before{ content: "${users[id].ten}"}`)
                        map[id] = users[id]
                    }
                })
        }
        renderUserCss(userIds)
    }

    function configSweetAlert() {
        swal = Swal.mixin({
            customClass: {
                confirmButton: "btn btn-success btn-sm",
                cancelButton: "btn btn-danger btn-sm",
                denyButton: "btn btn-primary btn-warning btn-sm"
            },
            didOpen: () => {
                layoutAction.rebuild.autoBmd(".swal2-popup");
            },
            buttonsStyling: false
        });

        //#region swal_config
        _swagConfig.toast = {
            toast: true,
            position: "top-right",
            showConfirmButton: false,
            showCloseButton: false,
            didOpen: toast => {
                layoutAction.rebuild.autoBmd(".swal2-popup");
                toast.addEventListener("mouseenter", window.Swal.stopTimer);
                toast.addEventListener("mouseleave", window.Swal.resumeTimer);
            },
            buttonsStyling: false
        };

        _swagConfig.toastTime = { ..._swagConfig.toast, timer: 1500 };
        _swagConfig.errorAjax = { ..._swagConfig.toastTime, title: "Lỗi khi gửi Request", icon: "error" };
        _swagConfig.addSuccess = { ..._swagConfig.toastTime, title: "Thêm thành công", icon: "success" };
        _swagConfig.error = { ..._swagConfig.toastTime, title: "Lỗi", icon: "error" };
        _swagConfig.addError = { ..._swagConfig.toastTime, title: "Thêm thất bại", icon: "error" };
        _swagConfig.updateSuccess = { ..._swagConfig.toastTime, title: "Cập nhật thành công", icon: "success" };
        _swagConfig.updateFailed = { ..._swagConfig.toastTime, title: "Cập nhật thất bại", icon: "error" };
        _swagConfig.deleteSuccess = { ..._swagConfig.toastTime, title: "Xóa thành công", icon: "success" };
        _swagConfig.deleteFailed = { ..._swagConfig.toastTime, title: "Xóa thất bại", icon: "error" };
        _swagConfig.notFoundMoreData = { ..._swagConfig.toastTime, title: "Còn gì nữa đâu mà xem!", icon: "warning" };
        //#endregion

        Toast = Swal.mixin(_swagConfig.toast);
    }

    // fix lỗi màn hình đen menu không kéo hết :V
    function fixMaterial() {
        $('#close-menu-mobile')[0].on('click', () => {
            $(".close-layer.visible")[0].click();
        })
    }

    function addPrototypeFormData() {
        FormData.prototype.fromObject = function (this: FormData, obj) {
            if (typeof obj !== "object") return;
            for (let [key, value] of Object.entries(obj)) {
                if (value instanceof Array) {
                    key += "[]";
                    for (let v of value) {
                        this.append(key, v);
                    }
                } else {
                    this.append(key, value);
                }
            }
            return this;
        };
    }

    function fixTooltip() {
        $.fn._tooltip = $.fn.tooltip;
        $.fn.tooltip = function (selector) {
            return this._tooltip(selector).off("focusin");
        };
    }

    function addHTMLTableElementPrototype() {
        const addBody = (table, action, body) => {
            $(table)
                .find("tbody")
            [action](body);
            if (table._eventsLoadBody instanceof Array)
                for (let evt of table._eventsLoadBody) evt(table, body);
        };
        HTMLTableElement.prototype._setLoadMore = function (config) {
            declare type _typeConfig = typeof config;

            const loadMoreButton = $(
                '<button class="btn btn-info w-100 mx-0">Xem thêm ...</button>'
            );
            const configDefault = {
                urlAjax:
                    this.getAttribute("load-more") || window.location.pathname,
                limit: 20,
                offset: $(this).find("tbody > tr").length,
                tableQuery: $(this).data("id")
                    ? `table[data-id="${$(this).data("id")}"]`
                    : "table[load-more]"
            };
            // Hàm layoutAction.rebuild.autoAddDeleteEventTable (thêm event xóa item trong table cho nút .delete-btn) cần điều này để giảm offset xuống
            this._isLoadMore = true;

            let oldConfig = { ...configDefault, ...config };
            // Để xác định table đã load hết hay chưa
            let isMaxRecord = false;
            loadMoreButton.insertAfter(this);

            this._setLoadMore = (config: _typeConfig) => {
                if (config instanceof Function)
                    config = config({ ...oldConfig });
                oldConfig = { ...oldConfig, ...config };
                if (Number.parseInt(oldConfig.offset) === 0) {
                    isMaxRecord = false;
                    $(this)
                        .children("tbody")
                        .html("");
                }
                if (config.isLoadNow) loadMoreButton[0].click();
            };

            loadMoreButton.on("click", () => {
                if (isMaxRecord) return Swal.fire(_swagConfig.notFoundMoreData);
                let c = oldConfig;
                $.ajax({
                    url: c.urlAjax,
                    method: "GET",
                    data: `no-layout&limit=${c.limit}&offset=${c.offset}`
                }).done(resp => {
                    const trArr = $(resp)
                        .find(c.tableQuery)
                        .find("tbody > tr");

                    // đánh dấu dã load hết record lên
                    if (trArr.length === 0) {
                        isMaxRecord = true;
                        return Swal.fire(_swagConfig.notFoundMoreData);
                    } else if (trArr.length !== c.limit) {
                        isMaxRecord = true;
                    }

                    c.offset += trArr.length;
                    this._appendBodyTable(trArr);
                });
            });
        };

        HTMLTableElement.prototype._loadMore = function () {
            throw "Chạy hàm _setLoadMore trước đi bạn ơi!";
        };
        HTMLTableElement.prototype._loadBodyTable = function (
            this: HTMLTableElement,
            body
        ) {
            addBody(this, "html", body);
        };
        HTMLTableElement.prototype._appendBodyTable = function (
            this: HTMLTableElement,
            body
        ) {
            addBody(this, "append", body);
        };
        HTMLTableElement.prototype._onLoadTableBody = function (
            this: HTMLTableElement,
            eventHandler
        ) {
            if (eventHandler instanceof Function) {
                if (!(this._eventsLoadBody instanceof Array))
                    this._eventsLoadBody = [];
                this._eventsLoadBody.push(eventHandler);
            }
        };
        HTMLTableElement.prototype._eachSelected = function (
            this: HTMLTableElement,
            callback
        ) {
            for (let tr of $(this)
                .children("tbody")
                .children("tr")) {
                if (tr._select[0].checked) callback(tr);
            }
        };

        HTMLTableElement.prototype._mapSelected = function (
            this: HTMLTableElement,
            callback
        ) {
            const output = [];
            for (let tr of $(this)
                .children("tbody")
                .children("tr")) {
                if (tr._select[0].checked) output.push(callback(tr));
            }
            return output;
        };
    }

    /**
     * Thêm $.fn.validateCustom ( dùng cho input viết từ component )
     */
    function addJqueryValidationCustom() {
        // add regex
        $.validator.addMethod(
            "regex",
            function (value, element, regexp) {
                var re = new RegExp(regexp);
                return this.optional(element) || re.test(value);
            },
            "Thông tin không hợp lệ"
        );
        // Custom jquery validation sang tiếng việt
        $.extend($.validator.messages, {
            required: "Thông tin này là bắt buộc.",
            remote: "Hãy sửa cho đúng.",
            email: "Hãy nhập email.",
            url: "Hãy nhập URL.",
            date: "Hãy nhập ngày.",
            dateISO: "Hãy nhập ngày (ISO).",
            number: "Hãy nhập số.",
            digits: "Hãy nhập chữ số.",
            creditcard: "Hãy nhập số thẻ tín dụng.",
            equalTo: "Hãy nhập thêm lần nữa.",
            extension: "Phần mở rộng không đúng.",
            maxlength: $.validator.format("Hãy nhập từ {0} kí tự trở xuống."),
            minlength: $.validator.format("Hãy nhập từ {0} kí tự trở lên."),
            rangelength: $.validator.format("Hãy nhập từ {0} đến {1} kí tự."),
            range: $.validator.format("Hãy nhập từ {0} đến {1}."),
            max: $.validator.format("Hãy nhập từ {0} trở xuống."),
            min: $.validator.format("Hãy nhập từ {0} trở lên.")
        });

        // Thêm hàm validate custom cho form của material ( viết từ component)
        $.fn.validateCustom = function (validate) {
            const validator = this.validate({
                ...validate,
                ...{
                    lang: "vi",
                    highlight: function (element) {
                        $(element).input('error', this.submitted[element.name])
                    },
                    unhighlight: function (element) {
                        $(element).input('error', '')
                    },
                    errorPlacement: error => { },
                }
            });
            window.validator = validator
            return validator;
        };
    }

    /**
     * Thêm $.fn._autoIndexTable ( Tự động đánh index cho table )
     */
    function addJqueryTableAutoIndex() {
        $.fn._autoIndexTable = function (this: JQuery<HTMLElement>) {
            this.each((i, element) => {
                const table = $(element);
                const trHead = table.find("thead > tr");
                if (!trHead.find(".auto-index-head")[0]) {
                    trHead.prepend(
                        $('<th class="auto-index-head"><strong>#</strong></th>')
                    );
                    element._onLoadTableBody(function () {
                        table._autoIndexTable();
                    });
                }
                table
                    .children("tbody")
                    .children("tr")
                    .each((i, tr) => {
                        if (!tr._ai) {
                            tr._ai = $("<td ai></td>");
                            tr.prepend(tr._ai[0]);
                        }
                        tr._ai.html(i + 1);
                    });
            });
            return this;
        };
    }

    function addSelectModeTable() {
        const checkbox = `<div class="form-check"><label class="form-check-label"><input class="form-check-input " type="checkbox"><span class="form-check-sign"><span class="check"></span></span></label></div>`;
        $.fn._addSelectRows = function (callback) {
            this.each(function (i, e) {
                const table = $(e);
                const trHead = table.find("thead > tr");
                // Tự động thêm checkbox select vào header (nếu không tồn tại)
                if (!trHead.find("th.select")[0]) {
                    trHead.prepend(
                        $(`<th class="select"></th>`).html(
                            (function () {
                                const cbSelectAll = $(checkbox);
                                // const selectToolTipText = [
                                //     '<span class="text-danger">Hủy chọn tất cả</span>',
                                //     '<span class="text-success">Chọn tất cả</span>'
                                // ]
                                // Thêm tooltip attribute
                                // cbSelectAll
                                //     .attr("data-toggle", "tooltip")
                                //     .attr("data-html", "true")
                                //     .attr("title", selectToolTipText[1]);
                                // Chọn hoặc hủy tất cả lựa chọn trong table
                                cbSelectAll
                                    .find("input")
                                    .on("input", function (evt) {
                                        const check = this.checked;
                                        // const message = selectToolTipText[check ? 0 : 1]
                                        // cbSelectAll.attr("data-original-title", message);
                                        // Tìm thẻ tooltip đang được view và thay đổi trực tiếp content bên trong
                                        // $(`#${cbSelectAll.attr("aria-describedby")} > .tooltip-inner`).html($(message)[0])
                                        table.find("tbody > tr").each(function (i, tr) {
                                            tr._select[0].checked = check;
                                        });
                                    });
                                cbSelectAll.tooltip();
                                return cbSelectAll;
                            })()
                        )
                    );
                    e._onLoadTableBody(function () {
                        table._addSelectRows(callback);
                    });
                }
                callback = callback instanceof Function ? callback : () => { };
                table
                    .children("tbody")
                    .children("tr")
                    .each((i, e) => {
                        if (!e._select) {
                            const jCheckbox = $(checkbox);
                            e._select = jCheckbox.find("input");
                            e.prepend($("<td sl></td>").append(jCheckbox)[0]);
                            callback(e._select[0]);
                        }
                    });
            });
            return this;
        };
    }
})();