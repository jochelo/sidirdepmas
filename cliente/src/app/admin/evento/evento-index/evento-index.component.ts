import {Component, OnInit} from '@angular/core';
import {EventoState} from '../../../store/reducers/evento.reducer';
import {AdminState} from '../../../store/reducers/admin.reducer';
import {Store} from '@ngrx/store';
import {irVistaEvento, paginateEventos} from '../../../store/actions/evento.actions';
import {Evento} from '../../../models/evento';
import {Router} from '@angular/router';

@Component({
  selector: 'mas-evento-index',
  templateUrl: './evento-index.component.html',
  styles: []
})
export class EventoIndexComponent implements OnInit {

  eventoState: EventoState;

  permisoValidarPersonas = 'validar-personas';

  constructor(private store: Store<AdminState>,
              private router: Router) {
  }

  ngOnInit(): void {
    this.store.subscribe((state: any) => {
      this.eventoState = state.admin.evento;
    });

    this.store.dispatch(irVistaEvento({
      location: 'index'
    }));

    this.store.dispatch(paginateEventos({
      items: 10,
      page: 1
    }));
  }

  onPaginate(event: any): void {
    this.store.dispatch(paginateEventos({
      items: event.pageSize,
      page: event.pageIndex + 1
    }));
  }

  onValidarInscritos(evento: Evento): void {
    this.store.dispatch(irVistaEvento({
      location: 'validar-personas',
      evento
    }));
  }

}
