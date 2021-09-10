import {Component, ElementRef, Inject, OnInit, ViewChild} from '@angular/core';
import {MAT_DIALOG_DATA, MatDialogRef} from '@angular/material/dialog';
import {FormBuilder, FormControl, FormGroup, Validators} from '@angular/forms';

@Component({
  selector: 'mas-dialog-persona-observacion-create',
  templateUrl: './dialog-persona-observacion-create.component.html',
  styles: [
  ]
})
export class DialogPersonaObservacionCreateComponent implements OnInit {

  @ViewChild('inputObservacion', {static: false}) inputObservacion: ElementRef;

  dataGroup: FormGroup;

  constructor(public dialogRef: MatDialogRef<DialogPersonaObservacionCreateComponent>,
              private fb: FormBuilder,
              @Inject(MAT_DIALOG_DATA) public data: any) { }

  ngOnInit(): void {
    this.dataGroup = this.fb.group({
      observacion: new FormControl(null, [Validators.required])
    });
    setTimeout( () => {
      this.inputObservacion.nativeElement.focus();
    }, 300);
  }

  onSubmit(): void {
    if (this.dataGroup.value.observacion !== null) {
      this.dialogRef.close(this.dataGroup.value.observacion);
    }
  }

  onClose(): void {
    this.dialogRef.close();
  }

}
