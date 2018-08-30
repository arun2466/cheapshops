import {takeLatest} from 'redux-saga/effects';
import { signUpRequest, signUpRequestSuccess, signUpRequestFailed } from '../actions/auth'
import * as constants from '../constants'
import {call, put,all, takeEvery} from 'redux-saga/effects';

import * as SERVICES from '../services'

export function* watchSignUpRequest (action) {
  console.log( action)
  console.log( action)
  console.log( action)
  console.log( action)
  console.log( action)

  try {
    console.log('----try')

    const response = yield call( SERVICES.apiCall, 'POST', 'http://localhost/cheapshops/api/api.php', {
      action: 'login',
      payload: action.payload
    })

    console.log('---response')
    console.log(response)


  } catch(e){
    console.log('----catch')
    console.log(e)
  }

  yield all(signUpRequestSuccess('ss'));
}



// export function* watchActions () {

//   console.log('asdasdasdas')

//   yield takeLatest(constants.SIGN_UP_REQUEST, aasignUpRequest);
// }

// export default function* sagas () {
//   yield [
//     watchActions()
//   ];
// }


export const authSagas = [
  takeEvery(constants.SIGN_UP_REQUEST, watchSignUpRequest),
]