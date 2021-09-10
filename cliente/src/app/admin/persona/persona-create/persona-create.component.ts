import {Component, OnInit} from '@angular/core';
import {validationMessages} from '../../../helpers/ms-validation';
import {NgxSpinnerService} from 'ngx-spinner';
import {FormBuilder, FormControl, FormGroup, Validators} from '@angular/forms';
import {Router} from '@angular/router';
import {Store} from '@ngrx/store';
import {AdminState} from '../../../store/reducers/admin.reducer';
import {CircunscripcionService} from '../../../services/circunscripcion.service';
import {UbicacionService} from '../../../services/ubicacion.service';
import {nombrePersonaValid, numberValid} from '../../../helpers/my-validate';
import {EventoService} from '../../../services/evento.service';
import {storePersona} from '../../../store/actions/persona.actions';
import {PersonaState} from '../../../store/reducers/persona.reducer';

@Component({
  selector: 'mas-persona-create',
  templateUrl: './persona-create.component.html',
  styles: []
})
export class PersonaCreateComponent implements OnInit {

  departamentos = [];
  circunscripciones = [];
  localidades = [];
  eventos = [];


  validations = validationMessages;

  checked = false;

  personaGroup: FormGroup;
  personaState: PersonaState;

  constructor(private spinner: NgxSpinnerService,
              private fb: FormBuilder,
              private router: Router,
              private store: Store<AdminState>,
              private circunscripcionService: CircunscripcionService,
              private eventoService: EventoService,
              private ubicacionService: UbicacionService) {
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
      carnet: new FormControl('', [
        Validators.required,
        Validators.minLength(5),
        Validators.maxLength(11),
        Validators.pattern(numberValid)]),
      expedicion_carnet: new FormControl('', Validators.required),
      extension_carnet: new FormControl(''),
      sexo: new FormControl(null, [Validators.required]),
      circunscripcion_id: new FormControl(null, [Validators.required]),
      localidad_id: new FormControl(null, [Validators.required]),
      direccion: new FormControl(null),
      evento_id: new FormControl(null)
    });

    this.store.subscribe( (state: any) => {
      this.personaState = state.admin.persona;
    });

    this.ubicacionService.getDepartamentos().subscribe((data: any) => {
      this.departamentos = data;
    });

    this.circunscripcionService.getCircunscripciones().subscribe((data: any) => {
      this.circunscripciones = data;
    });

    this.eventoService.getEventos().subscribe((data: any) => {
      this.eventos = data;
    });
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

  onStore(): void {
    this.store.dispatch(storePersona({
      persona: this.personaGroup.value
    }));
    this.personaGroup.reset();
  }

}
