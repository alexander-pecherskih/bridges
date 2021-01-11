import React from 'react'

import { HomePage, LoginPage, LogoutPage } from '../pages'
import DefaultLayout from '../layouts/DefaultLayout'
import { Switch, Route } from 'react-router-dom'

const App = () => {
  return (
    <DefaultLayout>
      <Switch>
        <Route exact path="/" component={HomePage} />
        {/*<Route path="/logout" component={LogoutPage} />*/}
        {/*<Route path="/login" component={LoginPage} />*/}
      </Switch>
    </DefaultLayout>
  )
}

export default App
