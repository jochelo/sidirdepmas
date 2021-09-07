import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { AdminRoutingModule } from './admin-routing.module';
import { AdminComponent } from './admin.component';
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
import { HomeComponent } from './home/home.component';


@NgModule({
  declarations: [
    AdminComponent,
    HomeComponent
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
    MatDatepickerModule,
    MatNativeDateModule,
    MatButtonToggleModule,
    MatMenuModule,
    MatDialogModule,
    NgxSpinnerModule,
    ImageCropperModule,
  ]
})
export class AdminModule { }
