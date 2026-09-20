import api from './api'

export interface LoginCredentials {
  username: string
  password: string
}

export const login = (credentials: LoginCredentials) => {
  return api.post('/login', credentials)
}