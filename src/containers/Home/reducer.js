import {handleActions} from 'redux-actions';
import Immutable from 'immutable';
import update from 'immutability-helper';
import * as constants from '../../constants'

let initialState = {
  home : []
}

const getHomePageData = (state, action) => update(state, {
  home: { $set: ['test','1212']}
});


export default handleActions({
  [constants.HOME_PAGE_DATA_REQUEST]: getHomePageData

}, initialState);