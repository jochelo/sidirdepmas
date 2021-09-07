import {Usuario} from '../../models/usuario';
import {Action, createReducer, on} from '@ngrx/store';
import {
  login,
  loginFailure,
  loginSuccess,
  register,
  registerFailure,
  registerSuccess, setAuth, setAuthFailure, setAuthSuccess,
  verifyAccount, verifyAccountFailure
} from '../actions/auth.actions';

export const authFeatureKey = 'auth';

export interface AuthState {
  usuario: Usuario;
  token: string;
  logged: boolean;
  loaded: boolean;
  loading: boolean;
  message: string;
  error: Error;
}

export const initialState: AuthState = {
  usuario: null,
  token: null,
  logged: false,
  loaded: false,
  loading: false,
  message: null,
  error: null
};

const authReducer = createReducer(
  initialState,
  on(login, (state: AuthState, props) => ({
    ...state,
    loading: true,
    loaded: false,
    message: 'Verificando credenciales',
    error: null
  })),
  on(verifyAccount, (state: AuthState, props) => ({
    ...state,
    loading: true,
    loaded: false,
    message: 'Verificando cuenta',
    error: null
  })),
  on(loginSuccess, (state: AuthState, props) => ({
    ...state,
    usuario: props.usuario,
    token: props.token,
    logged: true,
    loading: false,
    loaded: true,
  })),
  on(loginFailure, (state: AuthState, props) => ({
    ...state,
    loading: false,
    loaded: false,
    message: 'Credenciales Incorrectas',
    error: props.error
  })),
  on(verifyAccountFailure, (state: AuthState, props) => ({
    ...state,
    loading: false,
    loaded: false,
    message: 'Fallo al activar la cuenta, o ya fue validada',
    error: props.error
  })),
  on(register, (state: AuthState, props) => ({
    ...state,
    loading: true,
    loaded: false,
    message: 'Por favor espere, Esta operación puede demorar un poco',
    error: null
  })),
  on(registerSuccess, (state: AuthState, props) => ({
    ...state,
    loading: false,
    loaded: true,
    message: props.message,
    usuario: props.usuario,
    error: null
  })),
  on(registerFailure, (state: AuthState, props) => ({
    ...state,
    loading: false,
    loaded: false,
    message: null,
    error: props.error.error
  })),
  on(setAuth, (state: AuthState) => ({
    ...state,
    loading: true
  })),
  on(setAuthSuccess, (state: AuthState, props) => ({
    ...state,
    loading: false,
    logged: true,
    loaded: true,
    usuario: props.usuario
  })),
  on(setAuthFailure, (state: AuthState, props) => ({
    ...state,
    loading: false,
    logged: false,
    loaded: false,
    error: props.error
  })),
);

export function reducer(state: AuthState | undefined, action: Action): any {
  return authReducer(state, action);
}
