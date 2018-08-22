import {takeLatest} from 'redux-saga/effects';
import { getHomePageData } from './containers/Home/action'
import * as constants from './constants'

export function* watchActions () {
  yield takeLatest(constants.HOME_PAGE_DATA_REQUEST, getHomePageData);
}

export default function* sagas () {
  yield [
    watchActions()
  ];
}