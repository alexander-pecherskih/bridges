import React from 'react'
import { compose } from 'redux'
import { connect } from 'react-redux'

import App from './App'

const AppContainer = ({ identity }) => {
    return <App identity={ identity } />
}

const mapStateToProps = ({ auth: { identity } }) => {
    return { identity }
}

export default compose(
    connect(mapStateToProps)
)(AppContainer);