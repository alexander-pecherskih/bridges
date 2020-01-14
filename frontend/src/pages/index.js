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

const getPageTitle = (path, withProjectName = true) => {
    const page = pages.find((item) => {
        return item.path === path
    })
    const projectName = withProjectName ? 'The Bridge' : ''
    const divider = withProjectName ? ' :: ' : ''

    if (!page) {
        return projectName
    }

    return `${page.title}${divider}${projectName}`
}

export { LoginPage, HomePage, SettingsPage, ProfilePage, ProcessesPage }

export { getPageTitle }