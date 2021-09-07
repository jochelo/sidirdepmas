import { Component, OnInit } from '@angular/core';
import {select, Store} from '@ngrx/store';
import {AdminState} from '../../store/reducers/admin.reducer';
import {Observable} from 'rxjs';
import {selectNombreUsuario} from '../../store/selectors/auth.selectors';

@Component({
  selector: 'mas-home',
  templateUrl: './home.component.html',
  styles: [
  ]
})
export class HomeComponent implements OnInit {

  auth$: Observable<string>;

  constructor(private store$: Store<AdminState>) { }

  ngOnInit(): void {
    this.auth$ = this.store$.pipe(
      select(selectNombreUsuario)
    );
  }

}
