import {Component, Inject, OnInit} from '@angular/core';
import {MAT_DIALOG_DATA, MatDialogRef} from '@angular/material/dialog';
import {DialogPersonaObservacionCreateComponent} from '../dialog-persona-observacion-create/dialog-persona-observacion-create.component';

@Component({
  selector: 'mas-dialog-persona-observacion-index',
  templateUrl: './dialog-persona-observacion-index.component.html',
  styles: [
  ]
})
export class DialogPersonaObservacionIndexComponent implements OnInit {

  constructor(public dialogRef: MatDialogRef<DialogPersonaObservacionCreateComponent>,
              @Inject(MAT_DIALOG_DATA) public data: any) { }

  ngOnInit(): void {
  }

  onClose(): void {
    this.dialogRef.close();
  }

}
