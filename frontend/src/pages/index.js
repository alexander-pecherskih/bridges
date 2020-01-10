import LoginPage from './LoginPage'
import HomePage from './HomePage'
import SettingsPage from './SettingsPage'
import ProfilePage from './ProfilePage'
import ProcessesPage from './ProcessesPage'

const pages = [
    {
        path: '/',
        title: 'Главная',
    },
    {
        path: '/settings',
        title: 'Настройки',
    },
    {
        path: '/profile',
        title: 'Настройки пользователя',
    },
    {
        path: '/processes',
        title: 'Настройки процессов',
    },
]

const getPageTitle = (path) => {
    const page = pages.find((item) => {
        return item.path === path
    })

    if (!page) {
        return ''
    }

    return page.title
}

export { LoginPage, HomePage, SettingsPage, ProfilePage, ProcessesPage }

export { getPageTitle }