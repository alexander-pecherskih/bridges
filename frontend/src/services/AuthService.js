import axios from 'axios'
import jwt_decode from 'jwt-decode'
import Api from './Api'

const IDENTITY_KEY = 'identity'

export default class AuthService {
    getIdentity = (username, password) => {
        const identity = AuthService.getIdentityFromLocalStorage()

        if (identity !== null) {
            return new Promise( resolve => {
                resolve(identity)
            })
        }

        const data = {
            username,
            password,
            grant_type: 'password',
            client_id: 'app',
            client_secret: 'secret',
        }
        const formData = new FormData()
        for (let key in data) {
            formData.append(key, data[key])
        }

        return axios.post(
            Api.getUrl('/token'),
            formData,
            {
                headers: {'Content-Type': 'multipart/form-data'}
            }
        ).then((response) => {
            if (!response.data.hasOwnProperty('access_token')) {
                return
            }
            const jwt = jwt_decode(response.data.access_token)
            const identity = {
                user: jwt.sub,
            }
            AuthService.saveIdentityToLocalStorage(identity)
            return identity
        }).catch( (err) => {
            throw new Error('Неправильные имя пользователя или пароль')
        })
    }

    static getIdentityFromLocalStorage = () => {
        const identityString = localStorage.getItem(IDENTITY_KEY)

        return JSON.parse(identityString) || null
    }

    static saveIdentityToLocalStorage = (identity) => {
        localStorage.setItem(IDENTITY_KEY, JSON.stringify(identity))
    }

    static removeIdentityFromLocalStorage = () => {
        localStorage.removeItem(IDENTITY_KEY)
    }
}