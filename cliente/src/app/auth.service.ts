import {Injectable} from '@angular/core';
import {environment} from '../environments/environment.prod';
import {HttpClient} from '@angular/common/http';
import {Observable} from 'rxjs';
import {map} from 'rxjs/operators';
import {Router} from '@angular/router';
import {ToastrService} from 'ngx-toastr';

@Injectable({
  providedIn: 'root'
})
export class AuthService {

  base = environment.base;

  constructor(private http: HttpClient,
              private router: Router,
              private toastr: ToastrService) {
  }

  onLogin(data: any): Observable<any> {
    let url = this.base;
    if (data.usuario === undefined) {
      url += 'login';
    } else {
      url += 'login-social';
    }
    return this.http.post(`${url}`, data).pipe(
      map((success: any) => {
        const tokenAF = `Bearer ${success.token}`;
        localStorage.setItem('token-DirDepMas', btoa(tokenAF));
        return success;
      })
    );

  }

  sendEmailConfirm(base: string): Observable<any> {
    return this.http.post(`${this.base}send-email-confirm`, {base});
  }

  onRegister(data: any): Observable<any> {
    return this.http.post(`${this.base}register`, data);
  }

  onValidateAccount(hash: any): Observable<any> {
    return this.http.post(`${this.base}register-verify`, {hash}).pipe(
      map((success: any) => {
        const tokenAF = `Bearer ${success.token}`;
        localStorage.setItem('token-DirDepMas', btoa(tokenAF));
        return success;
      })
    );
  }

  /*return new Observable((observer) => {
    observer.next(true);
    observer.complete();
  });*/
  logout(): Observable<any> {
    this.toastr.success('Saliendo del sistema', 'Cerrando sesión');
    return this.http.get(`${this.base}logout`).pipe(
      map((response: any) => {
        localStorage.removeItem('token-DirDepMas');
        this.toastr.warning(response.success, 'Sesión Finalizada');
        this.router.navigate(['/']);
      })
    );
  }

  checkUniqueCuentaUsuario(cuenta: string): Observable<any> {
    return this.http.post(`${this.base}check-unique-cuenta-usuario`, {cuenta});
  }

  checkUniqueEmailUsuario(email: string): Observable<any> {
    return this.http.post(`${this.base}check-unique-email-usuario`, {email});
  }

  getUser(): Observable<any> {
    return this.http.post(`${this.base}get-user`, null);
  }
}
