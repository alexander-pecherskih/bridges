export default {
  authorize: (username, password) => {
    if (username === 'John') {
      return Promise.resolve('jwt')
    }

    /* eslint-disable-next-line */
    return Promise.reject({ message: 'error' })
  },

  logout: () => { },

  refreshTokenIsValid: () => true,

  refreshToken: () => Promise.resolve('jwt')
}
