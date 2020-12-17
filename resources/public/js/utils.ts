//@ts-no-check
//@ts-ignore
export const Utils = {
    showMessage(message = 'no message') {
        console.log(message)
    },
    randomString(length:number = 10): string {
        const characters = 'abcdefghijklmnopqrstuvwxyz'
        const charactersLength = characters.length;
        Utils.randomString = function () {
            let result = ''
            let charactersLength = characters.length
            for (let i = 0; i < length; i++) {
                result += characters.charAt(Math.floor(Math.random() * charactersLength))
            }
            return result
        }
        return Utils.randomString()
    },
    activeAllActionFromObject(obj) {
        for (let renderAction of Object.values(obj)) {
            if (renderAction instanceof Function) renderAction()
        }
    },
    loadScript(url) {
        const script = document.createElement('script')
        script.src = url
        return new Promise((resolve) => {
            script.onload = resolve
            document.head.append(script)
        })

    }
}