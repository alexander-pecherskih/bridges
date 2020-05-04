import React, { useEffect, useRef } from 'react'
import { Link } from 'react-router-dom'
import M from 'materialize-css'

import UserViewContainer from './UserViewContainer'
// import Icon from '../Icon'

const Divider = () => <li><div className="divider"></div></li>

const Sidebar = () => {
  const onMount = () => { M.Sidenav.init(sidebar) }
  const sidebar = useRef(null)

  useEffect(onMount, [])

  return <>
    <ul className="sidenav sidenav-fixed sidebar" ref={ sidebar } >
      <li>
        <UserViewContainer />
      </li>
      <li><Link to="/">
        {/* <Icon icon="home" /> */}
                Задачи
      </Link></li>
      <Divider/>
      <li><Link to="/processes">Процессы</Link></li>
      <li><Link to="/settings">Настройки</Link></li>
      {/* eslint-disable-next-line */}
      {/* <li><a href="#">Third Link With Waves</a></li> */}
    </ul>
    {/* eslint-disable-next-line */}
    {/* <a href="#" data-target="slide-out" className="sidenav-trigger"><i className="material-icons">menu</i></a> */}
  </>
}

export default Sidebar
