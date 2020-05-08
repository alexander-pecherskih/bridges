import React from 'react'
import { shallow } from 'enzyme'

import Modal from '../Modal'

afterEach(() => {
  jest.clearAllMocks()
})

describe('<Modal />', () => {
  const handleCancel = jest.fn()
  const handleSubmit = jest.fn()
  const mockProps = {
    title: 'Modal Title',
    submitTitle: 'SUBMIT',
    cancelTitle: 'CANCEL',
  }

  const wrapper = shallow(
    <Modal
      title="Modal Title"
      onSubmit={handleSubmit}
      onCancel={handleCancel}
      {...mockProps}
    >
      Modal content
    </Modal>
  )

  it('Render content', () => {
    expect(wrapper.find('[data-test="body"]').text()).toEqual('Modal content')
  })

  it('Render title', () => {
    expect(wrapper.find('[data-test="title"]').text()).toEqual('Modal Title')
  })

  it('Render buttons', () => {
    expect(wrapper.find('[data-test="submit-button"]').prop('title')).toEqual(
      'SUBMIT'
    )
    expect(wrapper.find('[data-test="cancel-button"]').prop('title')).toEqual(
      'CANCEL'
    )
  })

  it('Handle cancel', () => {
    wrapper.find('[data-test="close-button"]').simulate('click')
    expect(handleCancel).toHaveBeenCalledTimes(1)
  })

  it('Handle submit', () => {
    wrapper.find('[data-test="submit-button"]').simulate('click')
    expect(handleSubmit).toHaveBeenCalledTimes(1)
  })

  it('Handle close', () => {
    wrapper.find('[data-test="cancel-button"]').simulate('click')
    expect(handleCancel).toHaveBeenCalledTimes(1)
  })
})
