import {Component, OnInit} from '@angular/core';
import {FormBuilder, FormControl, FormGroup, Validators} from '@angular/forms';
import {validationMessages} from '../helpers/ms-validation';
import {Router} from '@angular/router';
import {Store} from '@ngrx/store';
import {AppState} from '../store/app.reducer';
import {login} from '../store/actions/auth.actions';
import {faFacebook, faGoogle} from '@fortawesome/free-brands-svg-icons';
import {AuthService} from '../auth.service';
import {FacebookLoginProvider, GoogleLoginProvider, SocialAuthService} from 'angularx-social-login';
import {AuthState} from '../store/reducers/auth.reducer';

@Component({
  selector: 'mas-login',
  templateUrl: './login.component.html',
  styles: []
})
export class LoginComponent implements OnInit {

  faGoogle = faGoogle;
  faFacebook = faFacebook;

  usuarioGroup: FormGroup;

  authState: AuthState;

  constructor(private router: Router,
              private fb: FormBuilder,
              private authService: AuthService,
              private socialAuthService: SocialAuthService,
              private store: Store<AppState>) {
  }

  ngOnInit(): void {
    this.usuarioGroup = this.fb.group({
      cuenta: new FormControl('', [Validators.required]),
      password: new FormControl('', [Validators.required]),
    });

    this.socialAuthService.authState.subscribe( (user) => {
      if (user !== null) {
        this.store.dispatch(login({
          usuario: user
        }));
        this.usuarioGroup.reset();
        this.socialAuthService.signOut();
      }
    });

    this.store.subscribe( (state: AppState) => {
      this.authState = state.auth;
    });
  }

  onStore(): void {
    this.store.dispatch(login({
      cuenta: this.usuarioGroup.value.cuenta,
      password: this.usuarioGroup.value.password
    }));
    this.usuarioGroup.reset();
  }

  onSocial(social: string): void {
    if (social === 'facebook') {
      this.socialAuthService.signIn(FacebookLoginProvider.PROVIDER_ID);
    }
    if (social === 'google') {
      this.socialAuthService.signIn(GoogleLoginProvider.PROVIDER_ID);
    }
  }

}
