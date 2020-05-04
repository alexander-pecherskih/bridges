/* eslint-disable-next-line */
import { default as jwtDecode } from 'jwt-decode'

import AuthService from './AuthService'
import axios from 'axios'

import { getUrl } from './url'

const LOGIN_URL = getUrl('/login')

export default class Api {
  static _fetch({ method = 'GET', url = '', token = null }) {
    const headers = {
      'Content-Type': 'application/json'
    }

    if (token) {
      headers.Authorization = `Bearer ${token}`
    }

    return axios(
      getUrl(url),
      {
        headers
      }
    )
  }

  static async fetchWithAuth(params, accessToken) {
    if (!accessToken) {
      return window.location.replace(LOGIN_URL)
    }

    const jwt = jwtDecode(accessToken)
    if (!jwt) {
      return window.location.replace(LOGIN_URL)
    }

    if (Date.now() >= jwt.exp * 1000) {
      await AuthService.refreshToken()
        .catch(() => {
          return window.location.replace(LOGIN_URL)
        })
    }

    params.token = accessToken

    return Api._fetch(params)
  }
}
