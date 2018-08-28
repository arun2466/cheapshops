import axios from 'axios';

const apiCall = ( method, url, payload ) => {
  let req = {
    method: method,
    url: url,
    data: payload
  }

  return axios(req)
  .then((response) => {
    console.log('response')
    console.log( response )
  })
  .catch((error) => {
    console.log('err')
    console.log(error)
  })
}

export {
  apiCall
}