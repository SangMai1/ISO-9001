//@ts-no-check
//@ts-ignore
const Utils = {
    randomString(length = 10): string {
        const characters = 'abcdefghijklmnopqrstuvwxyz'
        const charactersLength = characters.length;
        Utils.randomString = function () {
            let result = ''
            for (let i = 0; i < length; i++) {
                result += characters.charAt(Math.floor(Math.random() * charactersLength))
            }
            return result
        }
        return Utils.randomString()
    },
    activeAllActionFromObject(obj, args) {
        for (let renderAction of Object.values(obj)) {
            if (renderAction instanceof Function) renderAction.apply(obj, args)
        }
    },
    loadScript(url) {
        const script = document.createElement('script')
        script.src = url
        return new Promise<void>((resolve, reject) => {
            script.onload = function () { resolve(); script.remove() }
            script.onerror = function () { reject(); script.remove() }
            document.head.append(script)
        })
    },
    vnMap: (() => {
        let vnMap = { 'á': 'a', 'à': 'a', 'ả': 'a', 'ã': 'a', 'ạ': 'a', 'ă': 'a', 'ắ': 'a', 'ằ': 'a', 'ẳ': 'a', 'ẵ': 'a', 'ặ': 'a', 'â': 'a', 'ấ': 'a', 'ầ': 'a', 'ẩ': 'a', 'ẫ': 'a', 'ậ': 'a', 'é': 'e', 'è': 'e', 'ẻ': 'e', 'ẽ': 'e', 'ẹ': 'e', 'ê': 'e', 'ế': 'e', 'ề': 'e', 'ể': 'e', 'ễ': 'e', 'ệ': 'e', 'í': 'i', 'ì': 'i', 'ỉ': 'i', 'ĩ': 'i', 'ị': 'i', 'ó': 'o', 'ò': 'o', 'ỏ': 'o', 'õ': 'o', 'ọ': 'o', 'ô': 'o', 'ố': 'o', 'ồ': 'o', 'ổ': 'o', 'ỗ': 'o', 'ộ': 'o', 'ú': 'u', 'ù': 'u', 'ủ': 'u', 'ũ': 'u', 'ụ': 'u', 'ư': 'u', 'ứ': 'u', 'ừ': 'u', 'ử': 'u', 'ữ': 'u', 'ự': 'u', 'ý': 'y', 'ỳ': 'y', 'ỷ': 'y', 'ỹ': 'y', 'ỵ': 'y' };
        let mapLowCase = {};
        let specialCharacter = { '_': ' ', '-': ' ' };
        for (let i = 97; i < 123; i++) {
            mapLowCase[String.fromCharCode(i - 32)] = String.fromCharCode(i);
        }
        let vnLowCase = {}
        for (let key in vnMap) { vnLowCase[key.toUpperCase()] = vnMap[key] }
        return { ...vnMap, ...mapLowCase, ...specialCharacter, ...vnLowCase };
    })(),
    filterStringVnMap(filterValue: string) {

        // Chuyển dữ liệu để không phải so sánh 2 lần
        const map = Utils.vnMap
        let textArray = filterValue.toLowerCase().split('').map((value) => {
            let newVal = map[value];
            if (newVal) { return newVal; }
            return value;
        });
        const length = filterValue.length;

        return function (comparativeValue: string) {
            let countIndex = 0;
            let nextChar = textArray[countIndex];
            for (let char of comparativeValue) {
                if (countIndex !== length) {
                    if (nextChar === char || map[char] === nextChar) {
                        nextChar = textArray[++countIndex];
                    }
                } else {
                    break;
                }
            }
            return countIndex === length;
        }
    },
    formToForm(form1, form2) {
        let childs1: any[] = $(form1).find('input[name], textarea[name]') as any
        let childs2: any[] = $(form2).find('input[name], textarea[name]') as any
        if (childs1.length !== childs2.length) return
        for (let i = 0; i < childs1.length; ++i) {
            if (childs1[i].value) childs2[i].value = childs1[i].value
            else if (childs1[i].checked) childs2[i].checked = childs1[i].checked
        }
    },
    render: {
        nojs(html: JQuery<HTMLElement>) {
            html = $(html)
            console.log(html)
            html.find('*').each(function (i, e) {
                if (e.tagName.toLowerCase() === 'script') return e.remove()
                for (let attribute of e.attributes) {
                    if (attribute.name.toLowerCase().startsWith('on')) e.removeAttributeNode(attribute)
                }
            })
            return html
        }
    },
    widgetConstruct(obj) {
        for (let key of Object.getOwnPropertyNames(Object.getPrototypeOf(obj))) {
            if (key === 'constructor') continue
            obj[key] = obj[key]
        }
    }
}

