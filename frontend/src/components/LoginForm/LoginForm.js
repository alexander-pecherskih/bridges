import React, { useState } from 'react'
import PropTypes from 'prop-types'
import styles from './styles/LoginForm.module.css'
import TextInput from '../ui/Input/TextInput'
import Button from '../ui/Button'

const ErrorMessage = ({ errorMessage = '' }) => {
  if (errorMessage === '') {
    return null
  }

  return <p className={styles.errorMessage}>{errorMessage}</p>
}

ErrorMessage.propTypes = {
  errorMessage: PropTypes.string,
}

const LoginForm = ({
  enabled,
  login,
  errorMessage = '',
  signUpBlockVisible = false,
}) => {
  const [username, setUsername] = useState('')
  const [password, setPassword] = useState('')
  const loginHandle = () => {
    login(username, password)
  }

  return (
    <div className={styles.loginForm}>
      <div className={styles.formBody}>
        <div>
          <h2>Login</h2>
          <p>Sign in to your account</p>
          <TextInput
            name="username"
            label="Username"
            change={(e) => setUsername(e.target.value)}
          />
          <TextInput
            name="password"
            label="Password"
            change={(e) => setPassword(e.target.value)}
            type="password"
          />
          <ErrorMessage errorMessage={errorMessage} />
          <Button
            caption="Login"
            click={loginHandle}
            disabled={!enabled || username.length === 0}
          />
        </div>
        {signUpBlockVisible ? (
          <div>
            <h2>Sign up</h2>
            <p>Lorem ipsum.</p>
            <Button caption="Sign Up" click={() => {}} />
          </div>
        ) : null}
      </div>
    </div>
  )
}

LoginForm.propTypes = {
  enabled: PropTypes.bool.isRequired,
  login: PropTypes.func.isRequired,
  errorMessage: PropTypes.string,
  signUpBlockVisible: PropTypes.bool,
}

export default LoginForm
