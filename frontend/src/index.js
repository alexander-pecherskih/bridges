/* istanbul ignore file */
import React from 'react'
import ReactDOM from 'react-dom'
import { Provider } from 'react-redux'
import { BrowserRouter as Router } from 'react-router-dom'

import AppContainer from './components/App/AppContainer'
import ErrorBoundary from './components/ErrorBoundary'
import configureStore from './store'

import './styles/styles.scss'

const store = configureStore()

ReactDOM.render(
  <Provider store={ store } >
    <ErrorBoundary>
      <Router>
        <AppContainer />
      </Router>
    </ErrorBoundary>
  </Provider>,
  document.getElementById('root')
)
