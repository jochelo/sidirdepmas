import {Injectable} from '@angular/core';
import {Actions, createEffect, ofType} from '@ngrx/effects';
import {Router} from '@angular/router';
import {catchError, map, switchMap} from 'rxjs/operators';
import {of, range} from 'rxjs';
import {ToastrService} from 'ngx-toastr';
import {NgxSpinnerService} from 'ngx-spinner';
import {PersonaService} from '../../services/persona.service';
import {
  getPersonas,
  getPersonasFailure,
  getPersonasSuccess,
  paginatePersonas,
  paginatePersonasFailure,
  paginatePersonasSuccess, storePersona, storePersonaFailure, storePersonaSuccess
} from '../actions/persona.actions';
import {Persona} from '../../models/persona';
import {Paginate} from '../../models/paginate';

@Injectable()
export class PersonaEffects {

  getPersonas$ = createEffect(() =>
    this.actions$
      .pipe(
        ofType(getPersonas),
        switchMap(() => {
          return this.personaService.getPersonas()
            .pipe(
              map((response: Persona[]) => {
                return getPersonasSuccess({
                  personas: response
                });
              }),
              catchError(error => of(getPersonasFailure(error)))
            );
        })
      ));

  paginatePersonas$ = createEffect(() =>
    this.actions$
      .pipe(
        ofType(paginatePersonas),
        switchMap((props: any) => {
          return this.personaService.paginatePersonas(props)
            .pipe(
              map((response: any) => {
                const pages: number[] = [];
                range(1, 10).subscribe(item => pages.push(item * 10));
                return paginatePersonasSuccess({
                  personas: response.data,
                  paginacion: new Paginate(
                    response.current_page,
                    response.from,
                    response.last_page,
                    response.per_page,
                    response.to,
                    response.total,
                    pages
                  )
                });
              }),
              catchError(error => of(paginatePersonasFailure(error)))
            );
        })
      ));

  storePersonas$ = createEffect(() =>
    this.actions$
      .pipe(
        ofType(storePersona),
        switchMap((props: {persona: Persona | any}) => {
          return this.personaService.storePersona(props.persona)
            .pipe(
              map((response: Persona) => {
                this.toastr.success('Registro agregado exitosamente');
                return storePersonaSuccess({
                  persona: response
                });
              }),
              catchError(error => of(storePersonaFailure(error)))
            );
        })
      ));

  constructor(private actions$: Actions,
              private toastr: ToastrService,
              private spinner: NgxSpinnerService,
              private personaService: PersonaService,
              private router: Router) {

  }

}
