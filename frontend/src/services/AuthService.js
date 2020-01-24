import axios from 'axios'
import Api from './Api'

const ACCESS_TOKEN_KEY = 'access_token'
const REFRESH_TOKEN_KEY = 'refresh_token'

export default class AuthService {
    getToken = (username, password) => {
        const token = AuthService.getTokenFromLocalStorage()

        if (token !== null) {
            return new Promise( resolve => {
                resolve(token)
            })
        }

        const data = {
            username,
            password,
            grant_type: 'password',
            client_id: 'app',
            client_secret: 'secret',
        }

        return AuthService._fetchToken(data)
    }

    static refreshToken() {
        const refreshToken = AuthService.getTokenFromLocalStorage(REFRESH_TOKEN_KEY)
        const data = {
            refresh_token: refreshToken,
            grant_type: 'refresh_token',
            client_id: 'app',
            client_secret: 'secret',
        }

        return AuthService._fetchToken(data)
    }

    static _fetchToken(data) {
        const formData = new FormData()
        for (let key in data) {
            if (data.hasOwnProperty(key)) {
                formData.append(key, data[key])
            }
        }
        return axios.post(
            Api.getUrl('/token'),
            formData,
            {
                headers: {'Content-Type': 'multipart/form-data'}
            }
        ).then((response) => {
            if (!response.data.hasOwnProperty('access_token') || !response.data.hasOwnProperty('refresh_token')) {
                return
            }

            AuthService.saveTokenToLocalStorage(response.data.access_token)
            AuthService.saveTokenToLocalStorage(response.data.refresh_token, REFRESH_TOKEN_KEY)
            return response.data.access_token
        }).catch( (err) => {
            throw new Error('Неправильные имя пользователя или пароль')
        })
    }

    static getTokenFromLocalStorage(key = ACCESS_TOKEN_KEY) {
        const tokenString = localStorage.getItem(key)

        return JSON.parse(tokenString) || null
    }

    static saveTokenToLocalStorage(token, key = ACCESS_TOKEN_KEY) {
        localStorage.setItem(key, JSON.stringify(token))
    }

    static removeTokensFromLocalStorage() {
        localStorage.removeItem(ACCESS_TOKEN_KEY)
        localStorage.removeItem(REFRESH_TOKEN_KEY)
    }
}