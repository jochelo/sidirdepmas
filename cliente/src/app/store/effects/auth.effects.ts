import {Injectable} from '@angular/core';
import {Actions, createEffect, ofType} from '@ngrx/effects';
import {Router} from '@angular/router';
import {
  login,
  loginFailure,
  loginSuccess,
  register,
  registerFailure,
  registerSuccess, setAuth, setAuthFailure, setAuthSuccess,
  verifyAccount, verifyAccountFailure
} from '../actions/auth.actions';
import {catchError, map, switchMap} from 'rxjs/operators';
import {AuthService} from '../../auth.service';
import {Usuario} from '../../models/usuario';
import {of} from 'rxjs';
import {ToastrService} from 'ngx-toastr';
import {MatDialog} from '@angular/material/dialog';
import {ModalVerifyComponent} from '../../modal-verify/modal-verify.component';
import {NgxSpinnerService} from 'ngx-spinner';

@Injectable()
export class AuthEffects {

  constructor(private actions$: Actions,
              private toastr: ToastrService,
              private spinner: NgxSpinnerService,
              private dialog: MatDialog,
              private authService: AuthService,
              private router: Router) {

  }

  login$ = createEffect( () =>
    this.actions$
      .pipe(
        ofType(login),
        switchMap( (props) => {
          return this.authService.onLogin(props)
            .pipe(
              map((response: { token: string, usuario: Usuario }) => {
                this.router.navigate(['/admin']);
                return loginSuccess(response);
              }),
              catchError( error => of(loginFailure(error)))
            );
        })
      ));

  verifyAcount$ = createEffect( () =>
    this.actions$
      .pipe(
        ofType(verifyAccount),
        switchMap( (props: {hash: string}) => {
          return this.authService.onValidateAccount(props.hash)
            .pipe(
              map((response: { token: string, usuario: Usuario }) => {
                this.spinner.hide();
                this.toastr.success('Gracias por validar tu correo', '¡Validación exitosa!')
                this.router.navigate(['/admin']);
                return loginSuccess(response);
              }),
              catchError( error => {
                this.spinner.hide();
                return of(verifyAccountFailure(error));
              })
            );
        })
      ));

  register$ = createEffect( () =>
    this.actions$
      .pipe(
        ofType(register),
        switchMap( (props: {data: any}) => {
          return this.authService.onRegister(props.data)
            .pipe(
              map((response: { message: string, usuario: Usuario, error?: boolean, agregado?: boolean }) => {
                if (response.error === undefined) {
                  if (response.usuario.autorizado) {
                    this.toastr.success('Por favor verifique su correo electronico', '¡Registro exitoso!');
                    this.dialog.open(ModalVerifyComponent, {
                      data: {error: false, agregado: response.agregado }
                    });
                  } else {
                    this.toastr.success('Por favor espere que validemos su registro', '¡Registro exitoso!');
                    this.dialog.open(ModalVerifyComponent, {
                      data: {agregado: response.agregado }
                    });
                  }
                } else {
                  this.toastr.success('¡Registro exitoso!');
                  this.dialog.open(ModalVerifyComponent, {
                    data: {error: true, agregado: response.agregado }
                  });
                }
                this.spinner.hide();
                return registerSuccess(response);
              }),
              catchError( error => {
                this.spinner.hide();
                this.toastr.error('¡Algo salio mal!');
                return of(registerFailure(error));
              })
            );
        })
      ));
  setAuth$ = createEffect(() =>
    this.actions$
      .pipe(
        ofType(setAuth),
        switchMap(() => {
          return this.authService.getUser()
            .pipe(
              map((response: {
                success: Usuario
              }) => {
                return setAuthSuccess({
                  usuario: response.success
                });
              }),
              catchError(error => {
                this.router.navigate(['/login']);
                return of(setAuthFailure(error));
              })
            );
        })
      ));

}
