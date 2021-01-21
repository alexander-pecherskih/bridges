import React from 'react'
import PropTypes from 'prop-types'
import { Redirect, Route } from 'react-router'
import { connect } from 'react-redux'

const ProtectedRoute = ({ component: Component, authorized, ...rest }) => {
  return (
    <Route
      {...rest}
      render={(props) => {
        if (authorized) {
          return <Component {...props} />
        }

        return (
          <Redirect
            to={{
              pathname: '/login',
              state: {
                from: props.location,
              },
            }}
          />
        )
      }}
    />
  )
}
ProtectedRoute.propTypes = {
  component: PropTypes.element,
  authorized: PropTypes.bool.isRequired,
  location: PropTypes.string,
}

const mapStateToProps = ({ auth: { authorized } }) => {
  return { authorized }
}

export default connect(mapStateToProps)(ProtectedRoute)
