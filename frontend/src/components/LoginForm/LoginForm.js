import React from 'react'

const LoginForm = ({ loading = false, username = '', password = '', setUsername, setPassword, login }) => {
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

export default LoginForm