import {Injectable} from '@angular/core';
import {Actions, createEffect, ofType} from '@ngrx/effects';
import {Router} from '@angular/router';
import {catchError, map, switchMap} from 'rxjs/operators';
import {of, range} from 'rxjs';
import {ToastrService} from 'ngx-toastr';
import {NgxSpinnerService} from 'ngx-spinner';
import {EventoService} from '../../services/evento.service';
import {
  getEventos,
  getEventosFailure,
  getEventosSuccess,
  paginateEventos, paginateEventosFailure,
  paginateEventosSuccess
} from '../actions/evento.actions';
import {Evento} from '../../models/evento';
import {Paginate} from '../../models/paginate';

@Injectable()
export class EventoEffects {

  constructor(private actions$: Actions,
              private toastr: ToastrService,
              private spinner: NgxSpinnerService,
              private eventoService: EventoService,
              private router: Router) {

  }

  getEventos$ = createEffect(() =>
    this.actions$
      .pipe(
        ofType(getEventos),
        switchMap(() => {
          return this.eventoService.getEventos()
            .pipe(
              map((response: Evento[]) => {
                return getEventosSuccess({
                  eventos: response
                });
              }),
              catchError(error => of(getEventosFailure(error)))
            );
        })
      ));

  paginateEventos$ = createEffect(() =>
    this.actions$
      .pipe(
        ofType(paginateEventos),
        switchMap((props: any) => {
          return this.eventoService.paginateEventos(props)
            .pipe(
              map((response: any) => {
                const pages: number[] = [];
                range(1, 10).subscribe(item => pages.push(item * 10));
                return paginateEventosSuccess({
                  eventos: response.data,
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
              catchError(error => of(paginateEventosFailure(error)))
            );
        })
      ));

}
