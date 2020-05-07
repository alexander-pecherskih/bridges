import FormDataHelper from '../FormDataHelper'

describe('FormDataHelper', () => {
  describe('Create from object', () => {
    const formData = FormDataHelper.createFromObject({
      id: 1,
      title: 'Title value',
    })

    it('Check ID', () => {
      expect(formData.get('id')).toEqual('1')
    })

    it('Check TITLE', () => {
      expect(formData.get('title')).toEqual('Title value')
    })
  })
})
