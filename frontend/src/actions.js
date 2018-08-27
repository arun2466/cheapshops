import {createAction} from 'redux-actions';
import * as constants from './constants';

export const getHomePageData = createAction(constants.HOME_PAGE_DATA_REQUEST);