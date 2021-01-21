import axios from 'axios'
import MockAdapter from 'axios-mock-adapter'
import ApiRequest from '../../../http/ApiRequest'
import ProcessRepository from '../ProcessRepository'

describe('ProcessRepository', () => {
  let mock, apiRequest, r

  beforeEach(() => {
    const client = axios.create()
    mock = new MockAdapter(client)
    apiRequest = new ApiRequest({ client })
    r = new ProcessRepository(apiRequest)
  })

  it('list is received', async () => {
    mock.onGet('/process').reply(200, [{}, {}])

    const list = await r.list()

    expect(list.length).toEqual(2)
  })

  it('process is received', async () => {
    mock.onGet('/process/b512f40c-06b2-467f-a83a-b9f2ca4d0c24').reply(200, {})

    const process = await r.getById('b512f40c-06b2-467f-a83a-b9f2ca4d0c24')

    expect(process).toMatchObject({})
  })
})
