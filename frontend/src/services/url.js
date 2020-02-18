const BASE_URL = 'http://api.bridges.local'

export function getUrl(path) {
    return BASE_URL + path
}

export function getBaseUrl() {
    return BASE_URL
}