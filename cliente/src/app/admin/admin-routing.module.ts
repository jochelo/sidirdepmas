import {NgModule} from '@angular/core';
import {RouterModule, Routes} from '@angular/router';
import {AdminComponent} from './admin.component';
import {HomeComponent} from './home/home.component';
import {EventoIndexComponent} from './evento/evento-index/evento-index.component';
import {PersonaCreateComponent} from './persona/persona-create/persona-create.component';
import {AdminGuard} from '../guard/admin.guard';
import {NgxPermissionsGuard} from 'ngx-permissions';

const routes: Routes = [
  {
    path: '',
    component: AdminComponent,
    canActivate: [AdminGuard],
    children: [
      {
        path: 'home',
        component: HomeComponent,
      },
      {
        path: 'eventos-index',
        component: EventoIndexComponent,
        canActivate: [NgxPermissionsGuard],
        data: {
          permissions: {
            only: ['eventos'],
            redirectTo: 'admin/page-not-found'
          }
        },
      },
      {
        path: 'persona-create',
        component: PersonaCreateComponent,
        canActivate: [NgxPermissionsGuard],
        data: {
          permissions: {
            only: ['store-personas'],
            redirectTo: 'admin/page-not-found'
          }
        },
      },
      {
        path: '',
        redirectTo: 'home',
        pathMatch: 'full'
      },
      {
        path: '**',
        redirectTo: 'home',
        pathMatch: 'full'
      }
    ]
  },
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class AdminRoutingModule {
}
