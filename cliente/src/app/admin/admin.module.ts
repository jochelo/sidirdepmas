import {NgModule} from '@angular/core';
import {CommonModule} from '@angular/common';

import {AdminRoutingModule} from './admin-routing.module';
import {AdminComponent} from './admin.component';
import {MatListModule} from '@angular/material/list';
import {MatIconModule} from '@angular/material/icon';
import {MatSidenavModule} from '@angular/material/sidenav';
import {MatToolbarModule} from '@angular/material/toolbar';
import {MatButtonModule} from '@angular/material/button';
import {MatCardModule} from '@angular/material/card';
import {MatDividerModule} from '@angular/material/divider';
import {MatInputModule} from '@angular/material/input';
import {MatSelectModule} from '@angular/material/select';
import {MatCheckboxModule} from '@angular/material/checkbox';
import {MatDatepickerModule} from '@angular/material/datepicker';
import {MatNativeDateModule} from '@angular/material/core';
import {MatButtonToggleModule} from '@angular/material/button-toggle';
import {MatDialogModule} from '@angular/material/dialog';
import {NgxSpinnerModule} from 'ngx-spinner';
import {ImageCropperModule} from 'ngx-image-cropper';
import {CollapseModule} from 'ngx-bootstrap/collapse';
import {FormsModule, ReactiveFormsModule} from '@angular/forms';
import {EffectsModule} from '@ngrx/effects';
import {StoreModule} from '@ngrx/store';
import {adminEffects} from '../store/effects/admin.effects';
import {adminReducers} from '../store/reducers/admin.reducer';
import {MatMenuModule} from '@angular/material/menu';
import {HomeComponent} from './home/home.component';
import {ValidarPersonaComponent} from './persona/validar-persona/validar-persona.component';
import {EventoIndexComponent} from './evento/evento-index/evento-index.component';
import {PaginationModule} from 'ngx-bootstrap/pagination';
import {TooltipModule} from 'ngx-bootstrap/tooltip';
import { DialogPersonaObservacionCreateComponent } from './persona/dialog-persona-observacion-create/dialog-persona-observacion-create.component';
import {MatProgressSpinnerModule} from '@angular/material/progress-spinner';
import {ToastrModule} from 'ngx-toastr';
import { DialogPersonaObservacionIndexComponent } from './persona/dialog-persona-observacion-index/dialog-persona-observacion-index.component';
import { PersonaCreateComponent } from './persona/persona-create/persona-create.component';
import {MatRadioModule} from '@angular/material/radio';
import {NgSelectModule} from '@ng-select/ng-select';
import {NgxPermissionsModule} from 'ngx-permissions';
import {MatPaginatorModule} from '@angular/material/paginator';


@NgModule({
  declarations: [
    AdminComponent,
    HomeComponent,
    ValidarPersonaComponent,
    EventoIndexComponent,
    DialogPersonaObservacionCreateComponent,
    DialogPersonaObservacionIndexComponent,
    PersonaCreateComponent,

  ],
  imports: [
    CommonModule,
    AdminRoutingModule,
    CollapseModule,
    FormsModule,
    ReactiveFormsModule,
    EffectsModule.forFeature(adminEffects),
    StoreModule.forFeature('admin', adminReducers),
    MatListModule,
    MatIconModule,
    MatSidenavModule,
    MatToolbarModule,
    MatButtonModule,
    MatCardModule,
    MatDividerModule,
    MatInputModule,
    MatSelectModule,
    MatCheckboxModule,
    MatRadioModule,
    MatDatepickerModule,
    MatNativeDateModule,
    MatButtonToggleModule,
    MatMenuModule,
    MatDialogModule,
    MatProgressSpinnerModule,
    MatListModule,
    MatPaginatorModule,
    NgxSpinnerModule,
    ImageCropperModule,
    PaginationModule,
    TooltipModule,
    ToastrModule,
    NgSelectModule,
    NgxPermissionsModule.forChild(),
  ],
  entryComponents: [
    DialogPersonaObservacionCreateComponent,
    DialogPersonaObservacionIndexComponent
  ]
})
export class AdminModule {
}
