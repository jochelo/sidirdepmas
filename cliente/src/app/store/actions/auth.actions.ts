import {createAction, props} from '@ngrx/store';
import {Usuario} from '../../models/usuario';

export const login = createAction(
  '[Auth] Login',
  props<{ cuenta?: string, password?: string, usuario?: any }>()
);

export const verifyAccount = createAction(
  '[Auth] Verify Account',
  props<{ hash: string }>()
);

export const loginSuccess = createAction(
  '[Auth] Login Success',
  props<{ token: string, usuario: Usuario }>()
);

export const loginFailure = createAction(
  '[Auth] Login Failure',
  props<{ error: any }>()
);

export const verifyAccountFailure = createAction(
  '[Auth] Verify Account Failure',
  props<{ error: any }>()
);

export const register = createAction(
  '[Auth] Register',
  props<{ data: any }>()
);

export const registerSuccess = createAction(
  '[Auth] Register Success',
  props<{ message: string, usuario: Usuario }>()
);

export const registerFailure = createAction(
  '[Auth] Register Failure',
  props<{ error: any }>()
);

export const setAuth = createAction(
  '[Usuario] Set auth'
);
export const setAuthSuccess = createAction(
  '[Usuario] Set auth Success',
  props<{ usuario: Usuario }>()
);
export const setAuthFailure = createAction(
  '[Usuario] Set auth Failure',
  props<{ error: any }>()
);
