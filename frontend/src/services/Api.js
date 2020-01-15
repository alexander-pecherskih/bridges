const BASE_URL = 'http://api.bridges.local'

export default class Api {
    static getUrl(path = '') {
        return Api._getBaseUrl() + path
    }

    static _getBaseUrl() {
        return BASE_URL
    }
}