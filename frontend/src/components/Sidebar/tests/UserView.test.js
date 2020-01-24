import React from 'react'
import { shallow } from 'enzyme'

import UserView from '../UserView'

const userInfo = {
    id: '0',
    email: 'confirmed@bridges.local',
    name: {
        first: 'John',
        last: 'Silver'
    },
    avatar: '/images/avatar.jpg',
}

describe('<UserView />', () => {
    const wrapper = shallow(<UserView userInfo={ userInfo } />)

    it('Sidebar Have a User Name', () => {
        expect(wrapper.find('.user-view .user-view__name').text()).toBe(userInfo.name.first + ' ' + userInfo.name.last)
    })
    it('Sidebar Have a User Avatar', () => {
        expect(wrapper.find('.user-view .user-view__avatar').prop('src')).toBe(userInfo.avatar)
    })
})