import {ActionReducerMap} from '@ngrx/store';
import {AuthState} from './auth.reducer';
import * as fromAuth from './auth.reducer';

export interface AdminState {
  auth: AuthState;
}

export const adminReducers: ActionReducerMap<AdminState> = {
  auth: fromAuth.reducer,
};
