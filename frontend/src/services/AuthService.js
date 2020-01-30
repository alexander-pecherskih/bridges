import axios from 'axios'
import Api from './Api'
import FormDataHelper from './FormDataHelper'

const REFRESH_TOKEN_KEY = 'refresh_token'
const LOGIN_URL = '/login'

export default class AuthService {

    static getLoginUrl() {
        return LOGIN_URL
    }

    static authorize = (username, password) => {
        const data = {
            username,
            password,
            grant_type: 'password',
            client_id: 'app',
            client_secret: 'secret',
        }

        return AuthService._fetchToken(data)
    }

    static refreshTokenIsValid() {
        return AuthService._getRefreshTokenFromLocalStorage() !== null
    }

    static refreshToken() {
        const refreshToken = AuthService._getRefreshTokenFromLocalStorage()

        const data = {
            refresh_token: refreshToken,
            grant_type: 'refresh_token',
            client_id: 'app',
            client_secret: 'secret',
        }

        return AuthService._fetchToken(data)
    }

    static _fetchToken(data) {
        return axios.post(
            Api.getUrl('/token'),
            FormDataHelper.createFromObject(data),
            {
                headers: {'Content-Type': 'multipart/form-data'}
            }
        ).then((response) => {
            if (!response.data.hasOwnProperty('access_token') || !response.data.hasOwnProperty('refresh_token')) {
                throw new Error('Access Denied')
            }

            AuthService._saveRefreshTokenToLocalStorage(response.data.refresh_token)
            return response.data.access_token
        }).catch( () => {
            throw new Error('Неправильные имя пользователя или пароль')
        })
    }

    static _getRefreshTokenFromLocalStorage() {
        const tokenString = localStorage.getItem(REFRESH_TOKEN_KEY)

        return JSON.parse(tokenString) || null
    }

    static _saveRefreshTokenToLocalStorage(token) {
        localStorage.setItem(REFRESH_TOKEN_KEY, JSON.stringify(token))
    }

    static logout() {
        localStorage.removeItem(REFRESH_TOKEN_KEY)
    }
}