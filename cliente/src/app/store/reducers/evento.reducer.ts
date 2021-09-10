import {Action, createReducer, on} from '@ngrx/store';
import {Evento} from '../../models/evento';
import {Paginate} from '../../models/paginate';
import {
  getEventos,
  getEventosFailure,
  getEventosSuccess,
  irVistaEvento,
  paginateEventos, paginateEventosFailure, paginateEventosSuccess
} from '../actions/evento.actions';

export const eventoFeatureKey = 'evento';

export interface EventoState {
  evento: Evento;
  eventos: Evento[];
  paginacion: Paginate;
  logged: boolean;
  loaded: boolean;
  loading: boolean;
  location: string;
  message: string;
  error: Error;
}

export const initialState: EventoState = {
  evento: null,
  eventos: [],
  paginacion: null,
  logged: false,
  loaded: false,
  loading: false,
  location: null,
  message: null,
  error: null
};

const eventoReducer = createReducer(
  initialState,
  on(irVistaEvento, (state: EventoState, props) => ({
    ...state,
    location: props.location,
    evento: props.evento ? props.evento : null
  })),
  on(getEventos, (state: EventoState, props) => ({
    ...state,
    loading: true,
    loaded: false,
    message: 'Cargando Listado de Eventos',
  })),
  on(getEventosSuccess, (state: EventoState, props) => ({
    ...state,
    loading: false,
    loaded: true,
    eventos: props.eventos,
    message: null
  })),
  on(getEventosFailure, (state: EventoState, props) => ({
    ...state,
    loading: false,
    loaded: false,
    message: props.error.message,
    error: props.error
  })),
  on(paginateEventos, (state: EventoState, props) => ({
    ...state,
    loading: true,
    loaded: false,
    message: 'Cargando Lista de Eventos',
  })),
  on(paginateEventosSuccess, (state: EventoState, props) => ({
    ...state,
    loading: false,
    loaded: true,
    eventos: props.eventos,
    paginacion: props.paginacion,
    message: null
  })),
  on(paginateEventosFailure, (state: EventoState, props) => ({
    ...state,
    loading: false,
    loaded: false,
    message: props.error.message,
    error: props.error
  })),
);

export function reducer(state: EventoState | undefined, action: Action): any {
  return eventoReducer(state, action);
}
