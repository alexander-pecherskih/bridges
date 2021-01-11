export const set = (name, token) => {
  localStorage.setItem(name, token)
}

export const get = (name) => {
  return localStorage.getItem(name)
}

export const remove = (name) => {
  localStorage.removeItem(name)
}