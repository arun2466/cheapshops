import {handleActions} from 'redux-actions';
import Immutable from 'immutable';
import update from 'immutability-helper';
import * as constants from '../constants'

let initialState = {
  home : ""
}

const signUpRequest = (state, action) => update(state, {
  home: { $set: "req"}
});

const signUpRequestSuccess = (state, action) => update(state, {
  home: { $set: "success"}
});

const signUpRequestFailed = (state, action) => update(state, {
  home: { $set: "failed"}
});

export default handleActions({
  [constants.SIGN_UP_REQUEST]: signUpRequest,
  [constants.SIGN_UP_REQUEST_SUCCESS]: signUpRequestSuccess,
  [constants.SIGN_UP_REQUEST_FAILED]: signUpRequestFailed,

}, initialState);