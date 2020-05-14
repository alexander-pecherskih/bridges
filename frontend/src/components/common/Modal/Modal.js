import React from 'react'
import PropTypes from 'prop-types'

import Portal from '../Portal'

import styles from './styles/Modal.module.scss'
import Button from '../Button'

const Modal = ({
  title,
  submitTitle,
  cancelTitle,
  onCancel,
  onSubmit,
  children,
}) => {
  return (
    <Portal>
      <div className={styles.overlay}>
        <div className={styles.modal}>
          <div className={styles.header}>
            <div className={styles.title} data-test="title">
              {title}
            </div>
            <div
              className={styles.closeButton}
              onClick={onCancel}
              data-test="close-button"
            />
          </div>
          <div className={styles.body} data-test="body">
            {children}
          </div>
          <div className={styles.footer}>
            <Button
              onClick={onSubmit}
              title={submitTitle}
              data-test="submit-button"
            />
            <Button
              onClick={onCancel}
              title={cancelTitle}
              data-test="cancel-button"
            />
          </div>
        </div>
      </div>
    </Portal>
  )
}

Modal.propTypes = {
  title: PropTypes.string,
  submitTitle: PropTypes.string,
  cancelTitle: PropTypes.string,
  onCancel: PropTypes.func,
  onSubmit: PropTypes.func,
  children: PropTypes.node,
}

Modal.defaultProps = {
  title: 'Modal Title',
  submitTitle: 'Submit',
  cancelTitle: 'Cancel',
  onCancel: () => {},
  onSubmit: () => {},
  children: null,
}

export default Modal
