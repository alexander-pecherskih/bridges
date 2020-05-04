import React from 'react'
import { AuthServiceConsumer } from '../AuthServiceContext'

const getDisplayName = (WrappedComponent) => {
  return WrappedComponent.displayName || WrappedComponent.name || 'Component'
}

const withAuthService = () => (Wrapped) => {
  const WithAuthService = (props) => {
    return (
      <AuthServiceConsumer>
        {
          (authService) => {
            return (
              <Wrapped {...props} authService={ authService } />
            )
          }
        }
      </AuthServiceConsumer>
    )
  }
  WithAuthService.displayName = `WithAuthService(${getDisplayName(Wrapped)})`

  return WithAuthService
}

export default withAuthService
