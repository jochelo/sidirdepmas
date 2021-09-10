import {ActionReducerMap} from '@ngrx/store';
import {AuthState} from './auth.reducer';
import {PersonaState} from './persona.reducer';
import {EventoState} from './evento.reducer';
import * as fromAuth from './auth.reducer';
import * as fromPersona from './persona.reducer';
import * as fromEvento from './evento.reducer';

export interface AdminState {
  auth: AuthState;
  persona: PersonaState;
  evento: EventoState;
}

export const adminReducers: ActionReducerMap<AdminState> = {
  auth: fromAuth.reducer,
  persona: fromPersona.reducer,
  evento: fromEvento.reducer
};
