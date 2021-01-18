import axios from 'axios'
import toFormData from './toFormData'

const LOGIN_REQUEST = {
  grant_type: 'password',
  client_id: 'app',
  client_secret: 'secret',
}

const REFRESH_REQUEST = {
  grant_type: 'refresh_token',
  client_id: 'app',
  client_secret: 'secret',
}

export default class ApiRequest {
  constructor(options = {}) {
    this.accessToken = options.accessToken
    this.refreshToken = options.refreshToken
    this.baseURL = options.baseURL
    this.loginURL = options.loginURL || '/token'
    this.refreshURL = options.refreshURL || '/token'
    this.logoutRedirectURL = options.logoutRedirectURL || '/logout'
    this.client = options.client || axios.create({
      baseURL: this.baseURL,
    })

    this.refreshRequest = null
    this._registerInterceptors()
  }

  login = async (username, password) => {
    const { data } = await this.request({
      url: this.loginURL,
      method: 'post',
      data: this._getLoginRequest(username, password),
      headers: { 'Content-Type': 'multipart/form-data' }
    })

    this.accessToken = data.access_token
    this.refreshToken = data.refresh_token

    return { accessToken: this.accessToken, refreshToken: this.refreshToken }
  }

  logout = () => {
    this.accessToken = null
    this.refreshToken = null
  }

  request = (config) => {
    return this.client.request(config)
  }

  _getRefreshRequest() {
    return toFormData({
      ...REFRESH_REQUEST,
      refresh_token: this.refreshToken,
    })
  }

  _getLoginRequest(username, password) {
    return toFormData({
    ...LOGIN_REQUEST,
      username,
      password,
    })
  }

  _registerInterceptors() {
    this.client.interceptors.request.use((config) => {
      if (!this.accessToken) {
        return config
      }

      const newConfig = {
        headers: {},
        ...config
      }

      newConfig.headers.Authorization = `Bearer ${this.accessToken}`

      return newConfig
    }, (error) => {
      return Promise.reject(error)
    })

    this.client.interceptors.response.use((r) => r, async (error) => {
      if (!this.refreshToken || error.response.status !== 401 || error.config.retry) {
        return Promise.reject(error.response)
      }

      if (error.response.status === 401 && error.config.url === this.refreshURL) {
        window.location.replace(this.logoutRedirectURL)
        return Promise.reject(error.response)
      }

      if (!this.refreshRequest) {
        const requestData = this._getRefreshRequest()

        this.refreshRequest = this.request({
          url: this.refreshURL,
          method: 'post',
          headers: { 'Content-Type': 'multipart/form-data' },
          data: requestData
        })
      }

      const { data } = await this.refreshRequest

      this.accessToken = data.access_token
      this.refreshToken = data.refresh_token

      return this.client({
        ...error.response.config,
        retry: true
      })
    })
  }
}