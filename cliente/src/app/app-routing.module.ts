import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import {LoginComponent} from './login/login.component';
import {RegisterComponent} from './register/register.component';
import {ActivateAccountComponent} from './activate-account/activate-account.component';
import {AuthGuard} from './guard/auth.guard';
import {InformacionPersonaComponent} from './informacion-persona/informacion-persona.component';
import {AdminGuard} from './guard/admin.guard';

const routes: Routes = [
  {
    path: 'login',
    component: LoginComponent,
    canActivate: [AdminGuard]
  },
  {
    path: 'register',
    component: RegisterComponent
  },
  {
    path: 'activate-acount/:hash',
    component: ActivateAccountComponent
  },
  {
    path: 'informacion-persona/:idpersona/:idevento/:carnetTres',
    component: InformacionPersonaComponent
  },
  {
    path: 'admin',
    loadChildren: () => import('./admin/admin.module').then( m => m.AdminModule),
    canActivate: [AuthGuard]
  },
  {
    path: '',
    redirectTo: 'login',
    pathMatch: 'full'
  },
  {
    path: '**',
    redirectTo: 'login',
    pathMatch: 'full'
  }
];

@NgModule({
  imports: [RouterModule.forRoot(routes, {
    useHash: true,
    relativeLinkResolution: 'legacy'
  })],
  exports: [RouterModule]
})
export class AppRoutingModule { }
