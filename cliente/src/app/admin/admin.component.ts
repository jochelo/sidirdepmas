import {Component, Inject, OnInit} from '@angular/core';
import {adminItems} from './admin-items';
import {Observable} from 'rxjs';
import {AuthState} from '../store/reducers/auth.reducer';
import {select, Store} from '@ngrx/store';
import {AdminState} from '../store/reducers/admin.reducer';
import {Router} from '@angular/router';
import {ToastrService} from 'ngx-toastr';
import {AuthService} from '../auth.service';
import {selectCuentaUsuario, selectNombreUsuario} from '../store/selectors/auth.selectors';
import {setAuth} from '../store/actions/auth.actions';
import {environment} from '../../environments/environment.prod';
import {DOCUMENT} from '@angular/common';
import {NgxSpinnerService} from 'ngx-spinner';

@Component({
  selector: 'mas-admin',
  templateUrl: './admin.component.html',
  styles: [
  ]
})
export class AdminComponent implements OnInit {

  BASE_URL = environment.base;

  items = adminItems;

  auth$: Observable<string>;
  authState: AuthState;

  constructor(private store$: Store<AdminState>,
              public router: Router,
              private spinner: NgxSpinnerService,
              @Inject(DOCUMENT) document: any,
              private toastr: ToastrService,
              private authService: AuthService) { }

  ngOnInit(): void {
    this.auth$ = this.store$.pipe(
      select(selectNombreUsuario)
    );

    this.store$.subscribe((state: any) => {
      this.authState = state.auth;
    });

    if (this.authState.usuario === null) {
      this.store$.dispatch(setAuth());
    }
  }

  logout(): void {
    this.authService.logout().subscribe();
  }

  onSendEmail(): void {
    this.spinner.show();
    this.authService.sendEmailConfirm(document.location.href.split(this.router.url)[0]).subscribe(() => {
      this.spinner.hide();
      this.toastr.success('Por favor verifique su correo electronico', 'Correo enviado');
    });
  }

}
