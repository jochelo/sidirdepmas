import {Component, Inject, OnInit, ViewChild} from '@angular/core';
import {faCheck, faCropAlt, faRedoAlt, faTimes, faUndoAlt} from '@fortawesome/free-solid-svg-icons';
import {NgxSpinnerService} from 'ngx-spinner';
import {base64ToFile, ImageCroppedEvent, ImageCropperComponent, ImageTransform} from 'ngx-image-cropper';
import {FormBuilder, FormControl, FormGroup, Validators} from '@angular/forms';
import {BreakpointObserver, Breakpoints} from '@angular/cdk/layout';
import {
  cuentaValid,
  emailValid,
  equalPass,
  nombrePersonaValid,
  numberValid,
  passwordValid, validateCuentaUsuario, validateEmailUsuario
} from '../helpers/my-validate';
import {validationMessages} from '../helpers/ms-validation';
import {AuthState} from '../store/reducers/auth.reducer';
import {Store} from '@ngrx/store';
import {register} from '../store/actions/auth.actions';
import {toFormData} from '../helpers/toFormData';
import {AppState} from '../store/app.reducer';
import * as _moment from 'moment';
import * as _rollupMoment from 'moment';
import {Router} from '@angular/router';
import {DOCUMENT} from '@angular/common';
import {AuthService} from '../auth.service';
import {CircunscripcionService} from '../services/circunscripcion.service';
import {UbicacionService} from '../services/ubicacion.service';
import {STEPPER_GLOBAL_OPTIONS} from '@angular/cdk/stepper';

const moment = _rollupMoment || _moment;

@Component({
  selector: 'mas-register',
  templateUrl: './register.component.html',
  styles: [],
  providers: [{
    provide: STEPPER_GLOBAL_OPTIONS, useValue: {displayDefaultIndicatorType: false}
  }]
})
export class RegisterComponent implements OnInit {

  @ViewChild('imageCropper', {static: false}) imageCropper: ImageCropperComponent;
  @ViewChild('ciAntCropper', {static: false}) ciAntCropper: ImageCropperComponent;
  @ViewChild('ciPosCropper', {static: false}) ciPosCropper: ImageCropperComponent;

  departamentos = [];

  circunscripciones = [];
  localidades = [];

  validations = validationMessages;

  faTimes = faTimes;
  faCheck = faCheck;
  faCropAlt = faCropAlt;
  faUndoAlt = faUndoAlt;
  faRedoAlt = faRedoAlt;

  startDate = new Date(1968, 0, 1);

  checked = false;

  checkedMilitancia = false;

  resizeSmall = false;

  data: any = '';
  dataEvent: any = '';
  showDataEvent = false;
  showDataEventTemp = false;
  transform: ImageTransform = {rotate: 0};

  dataP: any = '';
  dataPEvent: any = '';
  showPDataEvent = false;
  transformP: ImageTransform = {rotate: 0};

  dataA: any = '';
  dataAEvent: any = '';
  showADataEvent = false;
  transformA: ImageTransform = {rotate: 0};

  personaGroup: FormGroup;

  authState: AuthState;

  constructor(private spinner: NgxSpinnerService,
              private fb: FormBuilder,
              private router: Router,
              private store: Store<AppState>,
              @Inject(DOCUMENT) document: any,
              private authService: AuthService,
              private circunscripcionService: CircunscripcionService,
              private ubicacionService: UbicacionService,
              private brealPoint: BreakpointObserver) {
    brealPoint.observe([
      Breakpoints.XSmall,
      Breakpoints.Small
    ]).subscribe(result => {
      this.resizeSmall = result.matches;
    });
  }

  ngOnInit(): void {
    this.personaGroup = this.fb.group({
      nombres: new FormControl('', [
        Validators.required,
        Validators.pattern(nombrePersonaValid),
        Validators.minLength(2),
        Validators.maxLength(30)]),
      apellido_paterno: new FormControl('', [
        Validators.required,
        Validators.pattern(nombrePersonaValid),
        Validators.minLength(2),
        Validators.maxLength(20)]),
      apellido_materno: new FormControl('', [
        Validators.required,
        Validators.pattern(nombrePersonaValid),
        Validators.minLength(2),
        Validators.maxLength(20)
      ]),
      fecha_nacimiento: new FormControl('', [
        Validators.required
      ]),
      carnet: new FormControl('', [
        Validators.required,
        Validators.minLength(5),
        Validators.maxLength(11),
        Validators.pattern(numberValid)]),
      expedicion_carnet: new FormControl('', Validators.required),
      extension_carnet: new FormControl(''),
      email: new FormControl('', [
        Validators.required,
        Validators.pattern(emailValid)
      ], validateEmailUsuario(this.authService)),
      imgcian: new FormControl(null, [Validators.required]),
      imgcirev: new FormControl(null, [Validators.required]),
      sexo: new FormControl(null, [Validators.required]),
      circunscripcion_id: new FormControl(null, [Validators.required]),
      localidad_id: new FormControl(null, [Validators.required]),
      direccion: new FormControl(null),
      gestion_militancia: new FormControl(null, [Validators.required,
        Validators.minLength(4),
        Validators.maxLength(4)]),
      foto: new FormControl(null),
      cuenta: new FormControl('', [
        Validators.required,
        Validators.pattern(cuentaValid),
        Validators.minLength(5),
        Validators.maxLength(20)], validateCuentaUsuario(this.authService)),
      password: new FormControl('', [
        Validators.required,
        Validators.pattern(passwordValid),
        Validators.minLength(5)]),
      confirm_password: new FormControl(null, [Validators.required]),
      base: new FormControl(document.location.href.split(this.router.url)[0])
    });

    this.ubicacionService.getDepartamentos().subscribe( (data: any) => {
      this.departamentos = data;
    });

    this.circunscripcionService.getCircunscripciones().subscribe((data: any) => {
      this.circunscripciones = data;
    });

    this.store.subscribe((response: AppState) => {
      this.authState = response.auth;
    });
  }

  uploadfile(event): void {
    if (event.target.files[0]) {
      this.spinner.show();
      this.dataEvent = event;
      this.showDataEventTemp = true;
    } else {
      this.dataEvent = '';
      this.data = '';
      this.personaGroup.patchValue({
        foto: null
      });
    }
  }

  uploadfileAnt(event): void {
    if (event.target.files[0]) {
      this.spinner.show();
      setTimeout(() => {
        this.dataAEvent = event;
        this.personaGroup.patchValue({
          imgcian: event.target.files[0]
        });
        const reader = new FileReader();
        reader.readAsDataURL(event.target.files[0]);
        reader.onload = (event) => {
          this.dataA = (<FileReader>event.target).result;
          this.spinner.hide();
        };
      }, 200);

    } else {
      this.dataAEvent = '';
      this.dataA = '';
      this.personaGroup.patchValue({
        imgcian: null
      });
    }
  }

  uploadfilePos(event): void {
    if (event.target.files[0]) {
      this.spinner.show();

      setTimeout(() => {
        this.dataPEvent = event;
        this.personaGroup.patchValue({
          imgcirev: event.target.files[0]
        });
        const reader = new FileReader();
        reader.readAsDataURL(event.target.files[0]);
        reader.onload = (event) => {
          this.dataP = (<FileReader>event.target).result;
          this.spinner.hide();
        };
      }, 200);

    } else {
      this.dataPEvent = '';
      this.dataP = '';
      this.personaGroup.patchValue({
        imgcirev: null
      });
    }
  }

  imageCropped(event: ImageCroppedEvent): void {
    if (this.showDataEventTemp) {
      setTimeout(() => {
        this.data = event.base64;
        this.showDataEventTemp = false;
        this.personaGroup.patchValue({
          foto: new File([base64ToFile(this.data)], this.dataEvent.name, {
            type: this.dataEvent.type
          })
        });
        this.spinner.hide();
      }, 200);
    }
  }

  saveData(): void {
    this.spinner.show();
    setTimeout(() => {
      this.data = this.imageCropper.crop().base64;
      this.showDataEvent = !this.showDataEvent;
      this.personaGroup.patchValue({
        foto: new File([base64ToFile(this.data)], this.dataEvent.name, {
          type: this.dataEvent.type
        })
      });
      this.spinner.hide();
    }, 200);
  }

  saveAData(): void {
    this.spinner.show();
    setTimeout(() => {
      this.dataA = this.ciAntCropper.crop().base64;
      this.showADataEvent = !this.showADataEvent;
      this.personaGroup.patchValue({
        imgcian: new File([base64ToFile(this.dataA)], this.dataAEvent.name, {
          type: this.dataAEvent.type
        })
      });
      this.spinner.hide();
    }, 200);
  }

  savePData(): void {
    this.spinner.show();
    setTimeout(() => {
      this.dataP = this.ciPosCropper.crop().base64;
      this.showPDataEvent = !this.showPDataEvent;
      this.personaGroup.patchValue({
        imgcirev: new File([base64ToFile(this.dataP)], this.dataPEvent.name, {
          type: this.dataPEvent.type
        })
      });
      this.spinner.hide();
    }, 200);
  }

  rotateLeft(tipo: string): void {
    if (tipo === 'anterior') {
      this.transformA = {
        rotate: this.transformA.rotate - 90
      };
    }
    if (tipo === 'posterior') {
      this.transformP = {
        rotate: this.transformP.rotate - 90
      };
    }
    if (tipo === 'perfil') {
      this.transform = {
        rotate: this.transform.rotate - 90
      };
    }
  }

  rotateRight(tipo: string): void {
    if (tipo === 'anterior') {
      this.transformA = {
        rotate: this.transformA.rotate + 90
      };
    }
    if (tipo === 'posterior') {
      this.transformP = {
        rotate: this.transformP.rotate + 90
      };
    }

    if (tipo === 'perfil') {
      this.transform = {
        rotate: this.transform.rotate + 90
      };
    }
  }

  hasExtension(check: boolean): void {
    this.checked = check;
    if (check) {
      this.personaGroup.get('extension_carnet').setValidators([
        Validators.required,
        Validators.maxLength(3)
      ]);
    } else {
      this.personaGroup.get('extension_carnet').clearValidators();
      this.personaGroup.get('extension_carnet').updateValueAndValidity();
    }
  }

  changePassword(): void {
    this.personaGroup.get('confirm_password').setValidators([Validators.required, equalPass(this.personaGroup)]);
  }

  changeCircunscripcion(): void {
    this.personaGroup.patchValue({
      localidad_id: null,
      direccion: null
    });
    if (this.personaGroup.get('circunscripcion_id').value !== null) {
      this.ubicacionService.getLocalidades(this.personaGroup.value.circunscripcion_id).subscribe((data: any) => {
        this.localidades = data;
      });
    } else {
      this.localidades = [];
    }
  }

  esMilitante(check: boolean): void {
    this.checkedMilitancia = check;
  }

  getValuePerson(name: string): boolean {
    return this.personaGroup.get(name).valid;
  }

  stepOneValid(): boolean {
    return this.getValuePerson('nombres') && this.getValuePerson('apellido_paterno') && this.getValuePerson('apellido_materno') && this.getValuePerson('email') && this.getValuePerson('fecha_nacimiento') && this.getValuePerson('carnet') && this.getValuePerson('expedicion_carnet') && this.getValuePerson('extension_carnet') && this.getValuePerson('sexo');
  }

  stepTwoValid(): boolean {
    return this.getValuePerson('imgcian') && this.getValuePerson('imgcirev');
  }

  stepThreeValid(): boolean {
    return this.getValuePerson('foto') && this.getValuePerson('cuenta') && this.getValuePerson('password') && this.getValuePerson('confirm_password');
  }

  stepFourValid(): boolean {
    return this.getValuePerson('circunscripcion_id') && this.getValuePerson('localidad_id');
  }

  onStore(): void {
    this.spinner.show();
    this.personaGroup.patchValue({
      fecha_nacimiento: moment(this.personaGroup.value.fecha_nacimiento).format('YYYY-MM-DD')
    });
    const form = toFormData(this.personaGroup.value);
    form.append('foto', this.personaGroup.value.foto);
    form.append('imgcian', this.personaGroup.value.imgcian);
    form.append('imgcirev', this.personaGroup.value.imgcirev);
    this.store.dispatch(register({
      data: form
    }));
    this.personaGroup.reset();
    this.dataEvent = '';
    this.data = '';
    this.dataAEvent = '';
    this.dataA = '';
    this.dataPEvent = '';
    this.dataP = '';
  }

}
