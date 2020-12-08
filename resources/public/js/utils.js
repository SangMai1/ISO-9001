export const Utils = {
    showMessage(message = 'no message') {
        console.log(message)
    },
    /**
     * @param {number} length
     * @returns {string}
     */
    randomString(length = 10) {
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
    }
}