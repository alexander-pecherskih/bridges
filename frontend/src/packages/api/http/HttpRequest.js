import axios from 'axios'

export default class HttpRequest {
  constructor(options = {}) {
    this.client = axios.create()
    this.baseUrl = options.baseUrl
    this.token = options.token
    this.refreshToken = options.refreshToken
    this.refreshRequest = options.refreshRequest

    this.client.interceptors.request.use((config) => {
      if (!this.token) {
        return config;
      }

      const newConfig = {
        headers: {},
        ...config
      }
      newConfig.headers.Authorization = `Bearer ${this.token}`

      return newConfig
    }, (error) => Promise.reject(error))

    this.client.interceptors.response.use((response) => response, async (error) => {
      if (
        !this.refreshToken ||
        error.response.status !== 401 ||
        error.config.retry
      ) {
        throw error;
      }

      if (!this.refreshRequest) {
        this.refreshRequest = this.client.post("/auth/refresh", {
          refreshToken: this.refreshToken,
        });
      }
      const { data } = await this.refreshRequest;
      this.token = data.token;
      this.refreshToken = data.refreshToken;
      const newRequest = {
        ...error.config,
        retry: true,
      };

      return this.client(newRequest);
    })
  }

  send({
    url = '/',
    method = 'GET',
    params = {},
    data = {},
    headers = {},
    formData = false,
  }) {
    data = formData ? this._formData(data) : data

    return this.client.request({
      baseURL: this.baseUrl, url, method, params, data, headers
    })
  }

  _formData(object) {
    const formData = new FormData()

    for (const key in object) {
      if (Object.prototype.hasOwnProperty.call(object, key)) {
        formData.append(key, object[key])
      }
    }

    return formData
  }
}
