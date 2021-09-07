import { Component, OnInit } from '@angular/core';
import {NgxSpinnerService} from 'ngx-spinner';
import {AuthService} from '../auth.service';
import {ActivatedRoute, Params, Router} from '@angular/router';
import {Store} from '@ngrx/store';
import {AppState} from '../store/app.reducer';
import {AuthState} from '../store/reducers/auth.reducer';
import {verifyAccount} from '../store/actions/auth.actions';

@Component({
  selector: 'mas-activate-account',
  templateUrl: './activate-account.component.html',
  styles: [
  ]
})
export class ActivateAccountComponent implements OnInit {

  authState: AuthState;

  constructor(private spinner: NgxSpinnerService,
              private route: ActivatedRoute,
              private store: Store<AppState>,
              private authService: AuthService) { }

  ngOnInit(): void {
    this.spinner.show();
    this.store.subscribe((response: AppState) => {
      this.authState = response.auth;
    });
    this.route.params.subscribe( (params: Params) => {
      this.store.dispatch(verifyAccount({
        hash: params.hash
      }));
    });
  }

}
