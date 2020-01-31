import React from 'react'
import { shallow } from 'enzyme'

import ProcessPropsEditor from './ProcessPropsEditor'

const process = {
    id: 1,
    title: 'process 1',
}

describe('<ProcessPropsEditor />', () => {

    describe('ProcessPropsEditor initial', () => {
        const wrapper = mount(<ProcessPropsEditor process={ process } loading={ false }/>)

        it('is showing', () => {
            expect(wrapper.find('input')).toHaveLength(2)
        })

        it('id is correct', () => {
            expect(wrapper.find('#id').prop('value')).toEqual(process.id)
        })
        it('title is correct', () => {
            expect(wrapper.find('#title').prop('value')).toEqual(process.title)
        })
    })

    describe('loading', () => {
        const wrapper = shallow(<ProcessPropsEditor process={ null } loading={ true }/>)

        it('ProcessPropsEditor load indicator', () => {
            expect(wrapper.find('TextMessage')).toHaveLength(1)
        })
    })

    describe('saving', () => {
        const saveClick = jest.fn()
        const wrapper = shallow(<ProcessPropsEditor
            process={ process }
            loading={ false }
            saving={ true }
            saveProcess={ saveClick }
        />)

        it('save clicked', () => {
            wrapper.find('button').simulate('click')
            expect(saveClick).toHaveBeenCalledTimes(1)
        })

        it('save button is disabled on saving', () => {
            wrapper.setProps({ saving: true })
            expect(wrapper.find('button').prop('disabled')).toBeTruthy()
        })

        it('save button is enabled after saving', () => {
            wrapper.setProps({ saving: false })
            expect(wrapper.find('button').prop('disabled')).toBeFalsy()
        })
    })

})