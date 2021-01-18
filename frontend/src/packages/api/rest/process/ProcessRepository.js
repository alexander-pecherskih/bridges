export default class ProcessRepository {
  constructor(request) {
    this.request = request
  }

  list() {
    return this.request.request({ url: '/process' })
      .then( (response) => response.data )
  }
}