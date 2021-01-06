// @ts-nocheck
// @ts-ignore
{
    $.Widget.prototype._waitDestroy = function (this) { setTimeout(() => this.element[this.widgetName]('destroy')) }
    $.widget.bridge = function (name, object) {
        var fullName = object.prototype.widgetFullName || name;
        $.fn[name] = function (options) {
            var isMethodCall = typeof options === "string";
            var args = Array.prototype.slice.call(arguments, 1);
            var returnValue = this;

            if (isMethodCall) {
                this.each(function () {
                    var methodValue;
                    var instance = $.data(this, fullName);

                    if (options === "instance") {
                        returnValue = instance;
                        return false;
                    }

                    if (!instance) return $(this)[name]()[name].apply($(this), [options, ...args])

                    if (!$.isFunction(instance[options]) || options.charAt(0) === "_") {
                        return $.error("no such method '" + options + "' for " + name +
                            " widget instance");
                    }

                    methodValue = instance[options].apply(instance, args);

                    if (methodValue !== instance && methodValue !== undefined) {
                        returnValue = methodValue && methodValue.jquery ?
                            returnValue.pushStack(methodValue.get()) :
                            methodValue;
                        return false;
                    }
                });
            } else {

                // Allow multiple hashes to be passed on init
                if (args.length) {
                    options = $.widget.extend.apply(null, [options].concat(args));
                }

                this.each(function () {
                    var instance = $.data(this, fullName);
                    if (instance) {
                        instance.option(options || {});
                        if (instance._init) {
                            instance._init();
                        }
                    } else {
                        $.data(this, fullName, new object(options, this));
                    }
                });
            }

            return returnValue;
        };
    };

}

//#region AutoComplete
type refsAutoComplete = {
    input: JQuery<HTMLElement>,
    autoComplete: JQuery<HTMLElement>,
    parent: JQuery<HTMLElement>,
    showMoreButton: JQuery<HTMLElement>,
}

let __widgetAutoCompleteInitConfig = {
    options: {
        renderData: (option: HTMLOptionElement) => $(`<div class="py-1 px-3">${option.innerText}</div>`),
        getFilter: (inputValue: string, callback: (comparativeValue: string) => boolean) => Utils.filterStringVnMap(inputValue),
        getComparativeValue: (option: HTMLOptionElement) => option.innerText.toLowerCase(),
        activeSelect: (renderedElement: HTMLElement) => $(renderedElement).addClass('active'),
        deactiveSelect: (renderedElement: HTMLElement) => $(renderedElement).removeClass('active'),
        getCompleteValue: (option: HTMLOptionElement) => option.innerText,
        renderEmpty: (option: HTMLOptionElement) => $(`<div class="py-1 px-3">${option.innerText}</div>`),
        isShowEmpty: true,
        isCache: true as boolean,
    },
    _create() {
        const e = this.element
        if (e[0].tagName.toLowerCase() !== 'select') return this._waitDestroy()
        {
            const emptyOption = $('<option disabled> ------ Bỏ qua ------ </option>')
            emptyOption.insertBefore(e.children('option:nth-child(1)'))

            const value = e.attr('value')
            if (value) e.val(value)
            if (!value || !e.children(':selected')[0]) emptyOption[0].selected = true
        }
        const refs = {} as refsAutoComplete
        e.addClass('d-none')
        this.refs = (callback) => (callback && callback instanceof Function) ? callback(refs) : refs

        refs.input = $('<input type="text" class="w-100 form-control input-complete">')
        refs.autoComplete = $('<div class="popup-complete"></div>').hide().on('mousedown', () => {
            this.isClickPopup = true
            setTimeout(() => this.isClickPopup = false)
        })
        refs.showMoreButton = $('<i class="fas fa-angle-down show-more-btn"></i>')
        refs.parent = $('<div class="w-100 d-flex align-items-end autocomplete-select"></div>')
            .append(
                $(`<div class="form-group"><label class="bmd-label-static">${e.attr('title') || ''}</label></div>`)
                    .append(refs.input)
                    .append(refs.autoComplete)
                    .append(refs.showMoreButton)
            )
        this.filter

        // add Events
        refs.input[0].on('input', () => { this.filter() })
        refs.input[0].on('focusin', () => { refs.input.val('') })
        refs.input[0].on('keydown', (evt) => {
            switch (evt.keyCode) {
                case 38: // up key
                    this.active((index) => index - 1)
                    break
                case 40: // down key
                    this.active((index) => index + 1)
                    if (refs.input.val() === '' && this.activeSelectIndex === undefined) this.filter()
                    break
                case 13: // enter key
                    evt.preventDefault()
                    this.activeSelectIndex !== undefined && this.clearFilter(true)
                    break
                case 27: // esc key
                    refs.input[0].blur()
                    break
            }

        })
        refs.input[0].on('blur', (evt) => {
            if (!this.isClickPopup) return this.clearFilter()
            this.isClickPopup = false
            refs.input[0].focus()
        })

        refs.showMoreButton[0].on('click', () => {
            refs.input[0].focus()
            this.filter()
        })

        this.filters = []
        this.clearFilter()
        refs.parent.insertAfter(e)

        if (layoutAction) layoutAction.rebuild.autoBmd(refs.parent)
    },
    /**
     * Lọc ra các các element được hiển thi lên
     */
    filter() {
        let { options: { isCache, getComparativeValue, getFilter, renderData, isShowEmpty, renderEmpty } } = this
        this.active(-1)
        const { input, autoComplete } = this.refs()

        const inputValue = input.val()
        const inputHeight = input[0].offsetHeight + 1
        const inputMargin = {
            top: Number.parseInt(input.css('margin-top').replace('px', '')),
            bot: Number.parseInt(input.css('margin-bottom').replace('px', ''))
        }

        autoComplete.empty()

        const setPosPopupAutoComplete = () => {
            const heightScreen = window.innerHeight
            const height = autoComplete[0].offsetHeight
            const top = autoComplete[0].getBoundingClientRect().top
            if ((top - (heightScreen / 2) + (this.isTop && (height + inputHeight + 5 + inputMargin.top + inputMargin.bot)) - 40) > 0) {
                autoComplete.css({ top: input.position().top - height })
                this.isTop = true
            } else {
                autoComplete.css({ top: input.position().top + inputMargin.top + inputMargin.bot + 1 + inputHeight })
                this.isTop = false
            }
        }

        let options = this.values

        if (!options) {
            const addEvent = (renderElement, option) => {
                renderElement[0].on('click', () => {
                    option.selected = true
                    this.clearFilter()
                })
                renderElement[0].on('mouseenter', () => {
                    this.active(renderElement[0]._index)
                })
            }
            options = this.element.children('option').toArray()
                .map((cur) => {
                    const renderElement = $(renderData(cur))
                    addEvent(renderElement, cur)
                    return [getComparativeValue(cur), renderElement, cur]
                })

            if (!isShowEmpty) options.splice(0, 1)
            else {
                options[0][1] = $(renderEmpty(options[0][2])).addClass('empty')
                addEvent(options[0][1], options[0][2])
            }
        }

        const filter = getFilter(inputValue)
        this.filters = options.filter(([value]) => filter(value))
        this.filters.forEach((optionArr, index) => {
            optionArr[1][0]._index = index
            autoComplete.append(optionArr[1])
        })

        if (isCache && !this.values) { this.values = options }
        else if (!isCache) { this.values = undefined }

        autoComplete.show()

        if (!this.interval) {
            setTimeout(() => {
                setPosPopupAutoComplete()
                setPosPopupAutoComplete()
            })
            this.interval = setInterval(setPosPopupAutoComplete, 100)
        }
    },
    clearFilter(isPushSelect = false) {
        const [{ input, autoComplete }, { element: e, options: { getCompleteValue }, activeSelectIndex: index }] = [this.refs(), this]
        if (isPushSelect) this.filters[index][2].selected = true
        const selected = e.children(':selected')[0]
        this.active(-1)
        this.filters = []
        selected && input.val(getCompleteValue(selected))
        clearInterval(this.interval)
        this.interval = undefined
        this.isClickPopup = false
        autoComplete.hide()
    },
    _destroy() {
        this.element.removeClass('d-none')
        clearInterval(this.interval)
        this.refs && this.refs().parent.remove()
    },
    active(index) {
        const length = this.filters.length
        if (length === 0) return this.activeSelectIndex = undefined
        // deactive
        let oldIndex = this.activeSelectIndex
        if (oldIndex !== undefined) this.options.deactiveSelect(this.filters[oldIndex][1])

        // active
        if (index !== -1) {
            oldIndex = Number.parseInt(oldIndex)
            if (isNaN(oldIndex) || !isFinite(oldIndex)) oldIndex = -1
            if (index instanceof Function) index = index(oldIndex)
            if (this.activeSelectIndex === undefined && index === -2) index = -1
            if (index >= 0) index %= length
            else index = length + (index % length)
            this.activeSelectIndex = index

            const filterElement = this.filters[index][1]
            this.options.activeSelect(filterElement)

            const parent = this.refs().autoComplete
            const heightParent = parent[0].offsetHeight
            const posTop = $(filterElement).position().top
            const parentTop = parent[0].scrollTop

            if (posTop < 0) parent[0].scrollTo({ top: parent[0].scrollTop + posTop - 1 })
            else if ((posTop + filterElement[0].offsetHeight) > heightParent) parent[0].scrollTo({ top: parent[0].scrollTop + posTop + filterElement[0].offsetHeight - heightParent + 1 })
        } else {
            this.activeSelectIndex = undefined
        }
    },
    clearSelect() {
        this.element[0].selectedIndex = 0
        this.clearFilter()
        type acs = { name: string }
    },
    clearCache() { this.values = null },
}

$.widget('custom.autoCompleteSelect', __widgetAutoCompleteInitConfig)
__widgetAutoCompleteInitConfig = undefined

interface JQuery<HTMLElement> {
    autoCompleteSelect: (
        ((options: typeof __widgetAutoCompleteInitConfig.options) => JQuery<HTMLElement>)
        & ((option: "option", options: typeof __widgetAutoCompleteInitConfig.options) => JQuery<HTMLElement>)
        & ((option: "clearCache") => JQuery<HTMLElement>)
        & ((option: "refs", callback: (refs: refsAutoComplete) => any) => JQuery<HTMLElement>)
        & ((option: "refs") => refsAutoComplete)
    )
}
//#endregion

//#region setErrorInput

class __widgetInputInitConfig {
    constructor() { Utils.widgetConstruct(this) }
    _refs: {
        feedback: JQuery<HTMLElement>,
        feedbackIcon: JQuery<HTMLElement>
    }
    options: {}
    _create() {
        this._refs = {}
        const refs = this._refs
        this.refs = () => refs
        this._drawError()
    }
    error(string: error) { }
    _destroy() { this.error(-1) }
    _drawError() {
        const refs = this._refs
        const getFeedBack = parent => {
            let feedback = $(parent).find(".invalid-feedback");
            feedback = feedback[0]
                ? feedback
                : $('<span class="invalid-feedback d-block"></span>');
            feedback.html("");
            return feedback;
        };
        const getFormControlFeedback = parent => {
            let controlFeedback = $(parent).find(".form-control-feedback");
            controlFeedback = controlFeedback[0]
                ? controlFeedback
                : $('<span class="form-control-feedback"></span>');
            controlFeedback.html($('<i class="fas fa-check"></i>'));
            return controlFeedback;
        };
        const addClass = (e, cl, reg) => e.attr("class", `${e.attr("class").replace(reg, "")} ${cl}`);

        const e = this.element
        switch (e.attr("type")) {
            case "checkbox":
            case "radio":
                {
                    const parent = e.closest(".form-check")
                    if (!parent[0]) return

                    refs.feedback = getFeedBack(parent)
                    parent.append(feedback)
                    this.error = function (err) { refs.feedback.html(err || "") }
                }
                break;
            default: {
                switch (e[0].tagName.toLowerCase()) {
                    case 'select':
                        {
                            if (!e.autoCompleteSelect('instance')) return
                            const input = e.autoCompleteSelect('refs').input.input()
                            this.error = function (error) { input.input('error', error === -1 ? '' : (error || '')) }
                        }
                        break
                    case 'textarea':
                        {
                            const parent = e.closest(".form-group");
                            if (!parent[0]) return;

                            refs.feedback = getFeedBack(parent);
                            parent.append(refs.feedback).append(refs.feedbackIcon);

                            this.error = function (error) { refs.feedback.html(error || "") }

                            this.error = function (error) {
                                refs.feedback.html(error === -1 ? '' : (error || ''))
                                addClass(parent, error === -1 ? '' : (error ? 'has-danger' : 'has-success'), /has-.*?(\s|$)/g)
                            }
                        }
                        break
                    case 'input':
                        {
                            const parent = e.closest(".form-group");
                            if (!parent[0]) return;

                            refs.feedback = getFeedBack(parent);
                            refs.feedbackIcon = getFormControlFeedback(parent);
                            const iconFeedback = refs.feedbackIcon.children("i");

                            parent.append(refs.feedback).append(refs.feedbackIcon);
                            let oldStatus = undefined;

                            this.error = function (error: string) {
                                refs.feedback.html(error || "");
                                let formGroupClass;
                                let iconClass;
                                if (error === -1) {
                                    formGroupClass = "";
                                    iconClass = "";
                                    refs.feedback.html("");
                                    oldStatus = undefined;
                                } else if (error) {
                                    if (oldStatus !== false) {
                                        formGroupClass = "has-danger";
                                        iconClass = "fa-exclamation";
                                        oldStatus = false;
                                    }
                                } else {
                                    if (oldStatus !== true) {
                                        formGroupClass = "has-success";
                                        iconClass = "fa-check";
                                        oldStatus = true;
                                    }
                                }
                                if (formGroupClass !== undefined) addClass(parent, formGroupClass, /has-.*?(\s|$)/g);
                                if (iconClass !== undefined) addClass(iconFeedback, iconClass, /fa-.*?(\s|$)/g);
                            };
                        }
                }

            }
        }

    }
    refs() { return this._refs }
}

$.widget('custom.input', { ... new __widgetInputInitConfig() })

interface JQuery<HTMLElement> {
    input: (
        ((options: typeof __widgetInputInitConfig.prototype.options) => JQuery<HTMLElement>)
        & ((option: "option", options: typeof __widgetInputInitConfig.prototype.options) => JQuery<HTMLElement>)
        & ((option: "refs") => typeof __widgetInputInitConfig.prototype._refs)
    )
}
__widgetInputInitConfig = undefined
//#endregion