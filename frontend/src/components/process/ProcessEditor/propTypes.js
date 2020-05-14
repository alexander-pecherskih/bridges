import PropTypes from 'prop-types'

const nodeType = PropTypes.shape({
  id: PropTypes.string.isRequired,
  position: PropTypes.shape({
    top: PropTypes.number,
    left: PropTypes.number,
  }).isRequired,
  title: PropTypes.string.isRequired,
})

export { nodeType }
