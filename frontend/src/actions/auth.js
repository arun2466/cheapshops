import {createAction} from 'redux-actions';
import * as CONSTANTS from '../constants'

export const signUpRequest = createAction(CONSTANTS.SIGN_UP_REQUEST);

// export const signUpRequest = data => ({
//   type: CONSTANTS.SIGN_UP_REQUEST,
//   data
// });

export const signUpRequestSuccess = data => ({
  type: CONSTANTS.SIGN_UP_REQUEST_SUCCESS,
  data
});

export const signUpRequestFailed = data => ({
  type: CONSTANTS.SIGN_UP_REQUEST_FAILED,
  data
});