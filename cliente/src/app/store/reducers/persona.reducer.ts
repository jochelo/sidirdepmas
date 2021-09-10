import {Action, createReducer, on} from '@ngrx/store';
import {Persona} from '../../models/persona';
import {Paginate} from '../../models/paginate';
import {
  getPersonas,
  getPersonasFailure,
  getPersonasSuccess,
  irVistaPersona,
  paginatePersonas,
  paginatePersonasFailure,
  paginatePersonasSuccess,
  storePersona,
  storePersonaFailure,
  storePersonaSuccess
} from '../actions/persona.actions';

export const personaFeatureKey = 'persona';

export interface PersonaState {
  persona: Persona;
  personas: Persona[];
  paginacion: Paginate;
  logged: boolean;
  loaded: boolean;
  loading: boolean;
  message: string;
  error: Error;
}

export const initialState: PersonaState = {
  persona: null,
  personas: [],
  paginacion: null,
  logged: false,
  loaded: false,
  loading: false,
  message: null,
  error: null
};

const personaReducer = createReducer(
  initialState,
  on(irVistaPersona, (state: PersonaState, props) => ({
    ...state,
    location: props.location
  })),
  on(getPersonas, (state: PersonaState, props) => ({
    ...state,
    loading: true,
    loaded: false,
    message: 'Cargando Listado de Personas',
  })),
  on(getPersonasSuccess, (state: PersonaState, props) => ({
    ...state,
    loading: false,
    loaded: true,
    personas: props.personas,
    message: null
  })),
  on(getPersonasFailure, (state: PersonaState, props) => ({
    ...state,
    loading: false,
    loaded: false,
    message: props.error.message,
    error: props.error
  })),
  on(paginatePersonas, (state: PersonaState, props) => ({
    ...state,
    loading: true,
    loaded: false,
    message: 'Cargando Lista de Personas',
  })),
  on(paginatePersonasSuccess, (state: PersonaState, props) => ({
    ...state,
    loading: false,
    loaded: true,
    personas: props.personas,
    paginacion: props.paginacion,
    message: null
  })),
  on(paginatePersonasFailure, (state: PersonaState, props) => ({
    ...state,
    loading: false,
    loaded: false,
    message: props.error.message,
    error: props.error
  })),
  on(storePersona, (state: PersonaState, props) => ({
    ...state,
    loading: true,
    loaded: false,
    message: 'Registrando Persona',
  })),
  on(storePersonaSuccess, (state: PersonaState, props) => ({
    ...state,
    loading: false,
    loaded: true,
    message: null
  })),
  on(storePersonaFailure, (state: PersonaState, props) => ({
    ...state,
    loading: false,
    loaded: false,
    message: props.error.message,
    error: props.error
  })),
);

export function reducer(state: PersonaState | undefined, action: Action): any {
  return personaReducer(state, action);
}
