import {createAction, props} from '@ngrx/store';
import {Evento} from '../../models/evento';
import {Paginate} from '../../models/paginate';

export const irVistaEvento = createAction(
  '[Evento] Ir a una vista de eventos',
  props<{ location: string, evento?: Evento }>()
);

export const getEventos = createAction(
  '[Evento] Lista de Eventos'
);

export const getEventosSuccess = createAction(
  '[Evento] Lista de Eventos Success',
  props<{ eventos: Evento[] }>()
);

export const getEventosFailure = createAction(
  '[Evento] Lista de Eventos Failure',
  props<{ error: any }>()
);

export const paginateEventos = createAction(
  '[Evento] Paginacion de Eventos',
  props<{ data?: any, items: number, page: number }>()
);

export const paginateEventosSuccess = createAction(
  '[Evento] Paginacion de Eventos Success',
  props<{ eventos: Evento[], paginacion: Paginate }>()
);

export const paginateEventosFailure = createAction(
  '[Evento] Paginacion de Eventos Failure',
  props<{ error: any }>()
);
