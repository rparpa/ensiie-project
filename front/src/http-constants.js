import Axios from 'axios'

let baseURL
if (!process.env.NODE_ENV || process.env.NODE_ENV === 'development') {
  baseURL = 'http://localhost:3000/'
} else {
  baseURL = 'http://parktonchar.com/'
}
export const HTTP = Axios.create(
  {
    baseURL: baseURL
  })