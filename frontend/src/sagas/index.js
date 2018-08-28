// import {
//   watchSignUpRequest
// } from './auth'

import { authSagas } from './auth';

import {call, put,all, takeLatest} from 'redux-saga/effects';

// import * as constants from '../constants'

// export default function* rootSaga(){
//   yield takeLatest(constants.SIGN_UP_REQUEST, watchSignUpRequest);
// }

export default function* rootSaga() {
  yield all([
    ...authSagas
  ])
}