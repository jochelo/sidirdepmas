import {createAction, props} from '@ngrx/store';
import {Persona} from '../../models/persona';
import {Paginate} from '../../models/paginate';

export const irVistaPersona = createAction(
  '[Persona] Ir a una vista de personas',
  props<{ location: string }>()
);

export const getPersonas = createAction(
  '[Persona] Lista de Personas'
);

export const getPersonasSuccess = createAction(
  '[Persona] Lista de Personas Success',
  props<{ personas: Persona[] }>()
);

export const getPersonasFailure = createAction(
  '[Persona] Lista de Personas Failure',
  props<{ error: any }>()
);

export const paginatePersonas = createAction(
  '[Persona] Paginacion de Personas',
  props<{ data: any, items: number, page: number }>()
);

export const paginatePersonasSuccess = createAction(
  '[Persona] Paginacion de Personas Success',
  props<{ personas: Persona[], paginacion: Paginate }>()
);

export const paginatePersonasFailure = createAction(
  '[Persona] Paginacion de Personas Failure',
  props<{ error: any }>()
);

export const storePersona = createAction(
  '[Persona] Crear Persona',
  props<{ persona: Persona | any }>()
);

export const storePersonaSuccess = createAction(
  '[Persona] Crear Persona Success',
  props<{ persona: Persona }>()
);

export const storePersonaFailure = createAction(
  '[Persona] Crear Persona Failure',
  props<{ error: any }>()
);
