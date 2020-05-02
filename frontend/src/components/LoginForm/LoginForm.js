import React from 'react'
import PropTypes from 'prop-types'

const ErrorMessage = ({ message }) => {
    return message ? <div className="error-message">{ message }</div> : null
}

ErrorMessage.propTypes = {
    message: PropTypes.string,
}

const LoginForm = ({ loading, username, password, setUsername, setPassword, login, errorMessage }) => {
    return (
        <div className="valign-wrapper"  style={ {height: '100vh'} }>
            <div className="container">
                <div className="row">
                    <div className="col m6 offset-m3 s10 offset-s1">
                        <div className="card">
                            <div className="card-content">
                                <div className="card-title">Login</div>
                                <form onSubmit={ (e) => e.preventDefault() }>
                                    <div className="input-field">
                                        <input
                                            id="username"
                                            type="text"
                                            disabled={ loading }
                                            onChange={ e => setUsername(e.target.value) }
                                            autoFocus={ true }
                                        />
                                        <label htmlFor="username" className="">Username</label>
                                    </div>

                                    <div className="input-field">
                                        <input
                                            id="password"
                                            type="password"
                                            disabled={ loading }
                                            onChange={ e => setPassword(e.target.value) }
                                        />
                                        <label htmlFor="password">Password</label>
                                        <ErrorMessage message={ errorMessage } />
                                    </div>
                                    <button
                                        className="btn"
                                        disabled={ loading || !password || !username }
                                        onClick={ login }
                                    >Log In</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    )
}

LoginForm.propTypes = {
    loading: PropTypes.bool,
    username: PropTypes.string,
    password: PropTypes.string,
    setUsername: PropTypes.func.isRequired,
    setPassword: PropTypes.func.isRequired,
    login: PropTypes.func.isRequired,
    errorMessage: PropTypes.string,
}

export default LoginForm