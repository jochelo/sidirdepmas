import {Component, Inject, OnInit} from '@angular/core';
import {AuthState} from '../store/reducers/auth.reducer';
import {Store} from '@ngrx/store';
import {AppState} from '../store/app.reducer';
import {MAT_DIALOG_DATA, MatDialogRef} from '@angular/material/dialog';

@Component({
  selector: 'mas-modal-verify',
  templateUrl: './modal-verify.component.html',
  styles: []
})
export class ModalVerifyComponent implements OnInit {

  authState: AuthState;

  constructor(private store: Store<AppState>,
              @Inject(MAT_DIALOG_DATA) public data: any) {
  }

  ngOnInit(): void {
    this.store.subscribe((state: AppState) => {
      this.authState = state.auth;
    });
  }

}
