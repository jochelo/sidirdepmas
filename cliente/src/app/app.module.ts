import {LOCALE_ID, NgModule} from '@angular/core';
import {BrowserModule} from '@angular/platform-browser';

import {AppRoutingModule} from './app-routing.module';
import {AppComponent} from './app.component';
import {LoginComponent} from './login/login.component';
import {RegisterComponent} from './register/register.component';
import {HTTP_INTERCEPTORS, HttpClientModule} from '@angular/common/http';
import {FormsModule, ReactiveFormsModule} from '@angular/forms';
import {BrowserAnimationsModule} from '@angular/platform-browser/animations';
import {FontAwesomeModule} from '@fortawesome/angular-fontawesome';
import {StoreModule} from '@ngrx/store';
import {StoreDevtoolsModule} from '@ngrx/store-devtools';
import {environment} from '../environments/environment.prod';
import {StoreRouterConnectingModule} from '@ngrx/router-store';
import {AuthEffects} from './store/effects/auth.effects';
import {EffectsModule} from '@ngrx/effects';
import {appReducers} from './store/app.reducer';
import {NavComponent} from './nav/nav.component';
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
import {MAT_DATE_FORMATS, MatNativeDateModule} from '@angular/material/core';
import {NgxSpinnerModule} from 'ngx-spinner';
import {ImageCropperModule} from 'ngx-image-cropper';
import {TooltipModule} from 'ngx-bootstrap/tooltip';
import {MatButtonToggleModule} from '@angular/material/button-toggle';
import {MomentDateModule} from '@angular/material-moment-adapter';
import {MY_DATE_FORMATS} from './helpers/date';
import {ToastrModule} from 'ngx-toastr';
import {ModalVerifyComponent} from './modal-verify/modal-verify.component';
import {MatDialogModule} from '@angular/material/dialog';
import {ActivateAccountComponent} from './activate-account/activate-account.component';
import {AppInterceptor} from './app.interceptor';
import {
  FacebookLoginProvider,
  GoogleLoginProvider,
  SocialAuthServiceConfig,
  SocialLoginModule
} from 'angularx-social-login';
import {MatProgressSpinnerModule} from '@angular/material/progress-spinner';
import {MatStepperModule} from '@angular/material/stepper';
import {MatRadioModule} from '@angular/material/radio';
import {NgSelectModule} from '@ng-select/ng-select';

@NgModule({
  declarations: [
    AppComponent,
    LoginComponent,
    RegisterComponent,
    NavComponent,
    ModalVerifyComponent,
    ActivateAccountComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    HttpClientModule,
    FormsModule,
    BrowserAnimationsModule,
    ReactiveFormsModule,
    FontAwesomeModule,
    StoreModule.forRoot(appReducers, {
      runtimeChecks: {
        strictStateImmutability: false,
        strictActionImmutability: false,
        // disabled until https://github.com/ngrx/platform/issues/2109 is resolved
        /* strictActionImmutability: true, */
      },
    }),
    StoreDevtoolsModule.instrument({maxAge: 25, logOnly: environment.production}),
    EffectsModule.forRoot([AuthEffects]),
    StoreRouterConnectingModule.forRoot(),
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
    MatDialogModule,
    MatProgressSpinnerModule,
    MatStepperModule,
    MatRadioModule,
    NgxSpinnerModule,
    ImageCropperModule,
    TooltipModule.forRoot(),
    MomentDateModule,
    ToastrModule.forRoot(),
    SocialLoginModule,
    NgSelectModule
  ],
  providers: [
    MatDatepickerModule,
    {provide: MAT_DATE_FORMATS, useValue: MY_DATE_FORMATS},
    {
      provide: LOCALE_ID, useValue: 'es-Bo'
    },
    {
      provide: HTTP_INTERCEPTORS,
      useClass: AppInterceptor,
      multi: true
    },
    {
      provide: 'SocialAuthServiceConfig',
      useValue: {
        autoLogin: false,
        providers: [
          {
            id: GoogleLoginProvider.PROVIDER_ID,
            provider: new GoogleLoginProvider('565847631193-aigrne0kcf83pfttlilj8d8ilmdp2058.apps.googleusercontent.com')
          },
          {
            id: FacebookLoginProvider.PROVIDER_ID,
            provider: new FacebookLoginProvider('286015789890209')
          }
        ]
      } as SocialAuthServiceConfig,
    }
  ],
  bootstrap: [AppComponent]
})
export class AppModule {
}
