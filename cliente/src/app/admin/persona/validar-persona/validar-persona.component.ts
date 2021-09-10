import {Component, Input, OnInit} from '@angular/core';
import {EventoState} from '../../../store/reducers/evento.reducer';
import {Store} from '@ngrx/store';
import {AdminState} from '../../../store/reducers/admin.reducer';
import {PersonaState} from '../../../store/reducers/persona.reducer';
import {paginatePersonas} from '../../../store/actions/persona.actions';
import {Persona} from '../../../models/persona';
import {MatDialog} from '@angular/material/dialog';
import {DialogPersonaObservacionCreateComponent} from '../dialog-persona-observacion-create/dialog-persona-observacion-create.component';
import {PersonaService} from '../../../services/persona.service';
import {ToastrService} from 'ngx-toastr';
import {irVistaEvento} from '../../../store/actions/evento.actions';
import {environment} from '../../../../environments/environment.prod';
import {DialogPersonaObservacionIndexComponent} from '../dialog-persona-observacion-index/dialog-persona-observacion-index.component';
import {FormBuilder, FormControl, FormGroup} from '@angular/forms';
import jsPDF from 'jspdf';
import 'jspdf-autotable';
import * as QRious from '../../../../../node_modules/qrious/dist/qrious';
import {bandera, cruzAndina, linea, logo, wiphala} from '../../../helpers/images-64';
import {Router} from '@angular/router';
import {NgxPermissionsService} from 'ngx-permissions';

@Component({
  selector: 'mas-validar-persona',
  templateUrl: './validar-persona.component.html',
  styles: []
})
export class ValidarPersonaComponent implements OnInit {

  @Input() eventoState: EventoState;

  cupoInscritos = null;

  personaState: PersonaState;
  BASE_URL = environment.base;

  searchGroup: FormGroup;

  permisoAddObservacion = 'personas-evento-create-observacion';
  permisoVerObservaciones = 'personas-evento-show-observacion';
  permisoAprobar = 'personas-evento-aprobar';
  permisoRechazar = 'personas-evento-rechazar';
  permisoEditarInfo = 'personas-evento-editar-info';
  permisoCredenciales = 'personas-evento-credencial';

  permisoEditar = false;

  constructor(private store: Store<AdminState>,
              private personaService: PersonaService,
              private toastr: ToastrService,
              private fb: FormBuilder,
              private router: Router,
              private permissionsService: NgxPermissionsService,
              private dialog: MatDialog) {
    // this.permisoEditar = this.permissionsService.getPermission(this.permisoEditarInfo);
    this.permisoEditar = this.permissionsService.getPermission(this.permisoEditarInfo) !== undefined;
  }

  ngOnInit(): void {
    this.searchGroup = this.fb.group({
      idcircunscripcion: new FormControl(null),
      carnet: new FormControl(null),
      nombre: new FormControl(null),
      estado: new FormControl(null),
      evento_id: new FormControl(this.eventoState.evento.id)
    });

    this.store.subscribe((state: any) => {
      this.personaState = state.admin.persona;
    });

    this.store.dispatch(paginatePersonas({
      data: this.searchGroup.value,
      items: 10,
      page: 1
    }));

    this.personaService.showInscritosEvento(this.eventoState.evento.id).subscribe( (data: any) => {
      this.cupoInscritos = data;
    });
  }

  onShowPersona(persona: Persona): void {
    persona.show = true;
    this.personaService.showPersona(persona.id, this.eventoState.evento.id).subscribe((data: Persona) => {
      data.show = true;
      this.personaState.personas = this.personaState.personas.map((p: Persona) => {
        return data.id === p.id ? data : p;
      });
    });
  }

  onAddObservacion(persona: Persona): void {
    const dialogRef = this.dialog.open(DialogPersonaObservacionCreateComponent, {
      data: {
        persona
      }
    });

    dialogRef.afterClosed().subscribe((result: any) => {
      if (result) {
        this.personaService.storeObservacionPersona(result, persona.id, this.eventoState.evento.id).subscribe((data: Persona) => {
          data.show = true;
          this.personaState.personas = this.personaState.personas.map((p: Persona) => {
            return data.id === p.id ? data : p;
          });
          this.toastr.success('Observación registrada correctamente');
        });
      }
    });
  }

  onShowObservacion(persona: Persona): void {
    this.dialog.open(DialogPersonaObservacionIndexComponent, {
      data: {
        persona
      }
    });
  }

  onAprobar(persona: Persona): void {
    if (confirm(`¿Esta seguro de aprobar el registro de ${persona.nombre_completo}?`)) {
      this.personaService.aprobar(persona.id, this.eventoState.evento.id).subscribe((data: Persona) => {
        data.show = true;
        this.personaState.personas = this.personaState.personas.map((p: Persona) => {
          return data.id === p.id ? data : p;
        });
        this.toastr.success('Persona aprobada exitosamente');
      });
    }
  }

  onRechazar(persona: Persona): void {
    if (confirm(`¿Esta seguro de rechazar el registro de ${persona.nombre_completo}?`)) {
      this.personaService.rechazar(persona.id, this.eventoState.evento.id).subscribe((data: Persona) => {
        data.show = true;
        this.personaState.personas = this.personaState.personas.map((p: Persona) => {
          return data.id === p.id ? data : p;
        });
        this.toastr.success('Persona rechazada exitosamente');
      });
    }
  }

  onCredencial(persona: Persona): void {
    this.personaState.loading = true;
    this.personaState.message = 'Generando Credencial';
    this.personaService.showPersona(persona.id, this.eventoState.evento.id).subscribe((data: Persona) => {
      persona = data;

      const doc = new jsPDF('p', 'mm', [70, 105]);

      doc.addImage(wiphala, 'PNG', 0, 0, 70, 7);

      // Fondo
      doc.addImage(cruzAndina, 'PNG', 5, 26, 60, 70);

      // ENCABEZADO

      doc.setFillColor(`#dedcdb`);
      doc.roundedRect(1, 8, 68, 15, 1, 1, 'F');

      doc.addImage(logo, 'PNG', 2, 9, 17, 12);

      doc.setFont('Courier', 'bold');
      doc.setFontSize(11);
      doc.text(this.eventoState.evento.nombre, 22, 11, {
        maxWidth: 43,
        lineHeightFactor: 0.9
      });

      doc.setFont('Courier', 'normal');
      doc.setFontSize(5);
      doc.text(this.eventoState.evento.descripcion, 3, 26, {
        maxWidth: 65
      });

      doc.addImage(linea, 'PNG', 2, 30, 66, 2);

      // DATOS
      doc.setFontSize(11);

      doc.setFont('Courier', 'bold');
      doc.text('NOMBRE COMPLETO', 5, 35, {
        maxWidth: 35
      });
      doc.setFontSize(12);
      doc.setFont('Courier', 'normal');
      doc.text(`${persona.nombre_completo.toUpperCase()}`, 5, 40, {
        maxWidth: 35
      });
      doc.setFontSize(11);
      doc.setFont('Courier', 'bold');
      doc.text('CARGO', 5, 53, {
        maxWidth: 35
      });
      doc.setFontSize(12);
      doc.setFont('Courier', 'normal');
      doc.text(`${persona.cargo ? persona.cargo.toUpperCase() : ''}`, 5, 58, {
        maxWidth: 35
      });

      const foto = new Image();
      foto.src = `${this.BASE_URL}persona-foto-download/${persona.id}/ ${persona.foto_filename}`;
      doc.addImage(foto, 'PNG', 42, 35, 22, 22);

      // const imgQR = createCanvas(25, 25);
      const imgQR = new Image();

      const qr = new QRious({
        element: imgQR,
        value: `${window.location.origin}/#/informacion-persona/${persona.id}/${this.eventoState.evento.id}/${persona.carnet.substring(persona.carnet.length - 4)}`
      });
      doc.addImage(imgQR, 'PNG', 25, 60, 24, 24);

      doc.setFontSize(8);

      doc.text(`Del ${this.eventoState.evento.fecha_inicial} al ${this.eventoState.evento.fecha_final}`, 35, 88, {
        align: 'center',
        maxWidth: 45
      });
      doc.setFont('Courier', 'bold');
      doc.text(`"Podran morir las personas, pero jamas sus ideales"`, 35, 94, {
        align: 'center',
        maxWidth: 60
      });

      doc.addImage(bandera, 'PNG', 0, 99, 70, 5);

      window.open(doc.output('bloburl').toString(), '_blank', 'toolbar=no,status=no,menubar=no,scrollbars=no,resizable=no,modal=yes,top=200,left=350,width=600,height=400');
      // doc.save('credencial.pdf');
      this.personaState.loading = false;
      this.personaState.message = null;
    });
  }

  onSaveCargo(persona: Persona): void {
    this.personaService.saveCargo(persona.cargo, persona.id, this.eventoState.evento.id).subscribe((data: Persona) => {
      data.show = true;
      this.personaState.personas = this.personaState.personas.map((p: Persona) => {
        return data.id === p.id ? data : p;
      });
      this.toastr.success('Cargo actualizado exitosamente');
    });
  }

  onSaveObservacionEvento(persona: Persona): void {
    this.personaService.saveObservacionEvento(persona.observacion_evento, persona.id, this.eventoState.evento.id).subscribe((data: Persona) => {
      data.show = true;
      this.personaState.personas = this.personaState.personas.map((p: Persona) => {
        return data.id === p.id ? data : p;
      });
      this.toastr.success('Observación registrada exitosamente');
    });
  }

  onSaveTitular(persona: Persona): void {
    this.personaService.saveTitular(persona, persona.id, this.eventoState.evento.id).subscribe((data: Persona) => {
      data.show = true;
      this.personaState.personas = this.personaState.personas.map((p: Persona) => {
        return data.id === p.id ? data : p;
      });
      persona.titular ? this.toastr.success('La persona ahora es titular')
        : this.toastr.success('La persona ya no es titular');
    });

    this.cupoInscritos = null;
    this.personaService.showInscritosEvento(this.eventoState.evento.id).subscribe( (data: any) => {
      this.cupoInscritos = data;
    });
  }

  onSearch(): void {
    this.store.dispatch(paginatePersonas({
      data: this.searchGroup.value,
      items: 10,
      page: 1
    }));
  }

  onPaginate(event: any): void {
    this.store.dispatch(paginatePersonas({
      data: this.searchGroup.value,
      items: event.pageSize,
      page: event.pageIndex + 1
    }));
  }

  onBack(): void {
    this.store.dispatch(irVistaEvento({
      location: 'index'
    }));
  }

}
