import {takeLatest} from 'redux-saga/effects';
import { signUpRequest, signUpRequestSuccess, signUpRequestFailed } from '../actions/auth'
import * as constants from '../constants'
import {call, put,all} from 'redux-saga/effects';

export function* watchSignUpRequest (action) {
  console.log( action)
  console.log( action)
  console.log( action)
  console.log( action)
  console.log( action)
  yield put(signUpRequestSuccess('ss'));
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