// @ts-nocheck
// @ts-ignore

type refs = {
    input: JQuery<HTMLElement>,
    autoComplete: JQuery<HTMLElement>,
    parent: JQuery<HTMLElement>,
    showMoreButton: JQuery<HTMLElement>,
}

let widgetAutoCompleteInitConfig = {
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
        if (e[0].tagName.toLowerCase() !== 'select') return
        {
            const emptyOption = $('<option disabled> ------ Bỏ qua ------ </option>')
            emptyOption.insertBefore(e.children('option:nth-child(1)'))

            const value = e.attr('value')
            if (value) e.val(value)
            else emptyOption[0].selected = true
        }
        const refs = {} as refs
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
                    evt.preventDefault()
                    break
                case 40: // down key
                    this.active((index) => index + 1)
                    if (refs.input.val() === '' && this.activeSelectIndex === undefined) this.filter()
                    evt.preventDefault()
                    break
                case 13: // enter key
                    evt.preventDefault()
                    this.activeSelectIndex !== undefined && this.clearFilter(true)
                    return false
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
        this.active(-1)
        this.filters = []
        input.val(getCompleteValue(e.children(':selected')[0]))
        clearInterval(this.interval)
        this.interval = undefined
        this.isClickPopup = false
        autoComplete.hide()
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

$.widget('custom.autoCompleteSelect', widgetAutoCompleteInitConfig)
widgetAutoCompleteInitConfig = null

interface JQuery<HTMLElement> {
    autoCompleteSelect: (
        ((options: typeof widgetAutoCompleteInitConfig.options) => JQuery<HTMLElement>)
        & ((option: "option", options: typeof widgetAutoCompleteInitConfig.options) => JQuery<HTMLElement>)
        & ((option: "clearCache") => JQuery<HTMLElement>)
        & ((option: "refs", callback: (refs: refs) => any) => JQuery<HTMLElement>)
        & ((option: "refs") => refs)
    )
}
