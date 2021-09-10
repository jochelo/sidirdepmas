import { Injectable } from '@angular/core';
import { ActivatedRouteSnapshot, CanActivate, RouterStateSnapshot, UrlTree } from '@angular/router';
import { Observable } from 'rxjs';
import {AuthService} from '../auth.service';
import {NgxPermissionsService} from 'ngx-permissions';
import {map} from 'rxjs/operators';

@Injectable({
  providedIn: 'root'
})
export class AdminGuard implements CanActivate {

  constructor(private authService: AuthService,
              private permissionsService: NgxPermissionsService) {}
  canActivate(
    route: ActivatedRouteSnapshot,
    state: RouterStateSnapshot): Observable<boolean | UrlTree> | Promise<boolean | UrlTree> | boolean | UrlTree {
    if (state.url.search('login') === -1) {
      return this.authService.getPermisosUrlUser().pipe(
        map((data: any) => {
          console.log(data);
          this.permissionsService.loadPermissions(data.permisosAlias);
          return true;
        }));
    } else {
      this.permissionsService.flushPermissions();
      return true;
    }
  }
  
}
