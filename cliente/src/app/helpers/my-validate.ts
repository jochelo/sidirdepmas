// CUENTA USUARIO

import {AuthService} from '../auth.service';
import {AbstractControl, FormGroup} from '@angular/forms';
import {map} from 'rxjs/operators';

export const nombrePersonaValid = /^[a-zA-Z\s]+$/;
export const emailValid = /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9]+.+[a-zA-Z]+$/;
export const fechaValid = /^((0[1-9]|[1,2][0,9]|3[0,1])\/(0[1,9]|1[0,2])\/(\d{4}))$/;
export const numberValid = /^[0-9]+$/;
export const cuentaValid = /^[a-zA-Z0-9]+$/;
export const passwordValid = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])[a-zA-Z0-9]+$/;

export const equalPass = (formGroup: FormGroup) => {
  const pass = formGroup.value.password;
  return (control: AbstractControl) => {
    const value = control.value;
    return pass === value ? null : {
      areEqual: true
    };
  };
};

export const validateCuentaUsuario = (authService: AuthService) => {
  return (control: AbstractControl) => {
    const value = control.value;
    return authService.checkUniqueCuentaUsuario(value)
      .pipe(
        map(response => {
          return response ? null : {
            validCuenta: true
          };
        })
      );
  };
};

export const validateEmailUsuario = (authService: AuthService) => {
  return (control: AbstractControl) => {
    const value = control.value;
    return authService.checkUniqueEmailUsuario(value)
      .pipe(
        map(response => {
          return response ? null : {
            validEmail: true
          };
        })
      );
  };
};
