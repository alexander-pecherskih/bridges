import jwt_decode from 'jwt-decode'

import AuthService from './AuthService'
import axios from 'axios'

const BASE_URL = 'http://api.bridges.local'
const LOGIN_URL = '/login'

export default class Api {
    static getUrl(path = '') {
        return Api._getBaseUrl() + path
    }

    static _getBaseUrl() {
        return BASE_URL
    }

    static _fetch({ method = 'GET', url = '', token = null }) {
        const headers = {
            'Content-Type': 'application/json'
        }

        if (token) {
            headers.Authorization = `Bearer ${token}`;
        }

        return axios(
            Api.getUrl(url),
            {
                headers
            }
        )
    }

    static async fetchWithAuth(params) {
        const accessToken = AuthService.getTokenFromLocalStorage()
        if (!accessToken) {
            return window.location.replace(LOGIN_URL)
        }

        const jwt = jwt_decode(accessToken)
        if (!jwt) {
            return window.location.replace(LOGIN_URL)
        }

        if (Date.now() >= jwt.exp * 1000) {
            await AuthService.refreshToken()
                .catch((err) => {
                    return window.location.replace(LOGIN_URL)
                })
        }

        params.token = accessToken;

        return Api._fetch(params)
    }
}