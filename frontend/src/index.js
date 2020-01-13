import React from 'react'
import ReactDOM from 'react-dom'
import { Provider } from 'react-redux'

import AppContainer from './components/App/AppContainer'
import ErrorBoundary from './components/ErrorBoundary'
import configureStore from './store'

import './styles/styles.sass'

const store = configureStore()

ReactDOM.render(
    <Provider store={ store } >
        <ErrorBoundary>
            <AppContainer />
        </ErrorBoundary>
    </Provider>,
    document.getElementById('root')
)
