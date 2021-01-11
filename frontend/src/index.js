/* istanbul ignore file */
import React from 'react'
import ReactDOM from 'react-dom'
import { Provider } from 'react-redux'
import { BrowserRouter as Router } from 'react-router-dom'

import AppContainer from './components/App/AppContainer'
import api, { ApiProvider } from './packages/api'
import ErrorBoundary from './components/ErrorBoundary'
import configureStore from './store'

import './themes/default/index.css'

const store = configureStore()

ReactDOM.render(
  <Provider store={store}>
    <ErrorBoundary>
      <Router>
        <ApiProvider value={api}>
          <AppContainer />
        </ApiProvider>
      </Router>
    </ErrorBoundary>
  </Provider>,
  document.getElementById('root')
)
