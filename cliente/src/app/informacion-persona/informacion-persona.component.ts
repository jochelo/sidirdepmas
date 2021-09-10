import {Component, OnInit} from '@angular/core';
import {ActivatedRoute, Params} from '@angular/router';
import {environment} from '../../environments/environment.prod';
import {PersonaService} from '../services/persona.service';
import {Persona} from '../models/persona';
import {EventoService} from '../services/evento.service';
import {Evento} from '../models/evento';

@Component({
  selector: 'mas-informacion-persona',
  templateUrl: './informacion-persona.component.html',
  styles: []
})
export class InformacionPersonaComponent implements OnInit {

  BASE_URL = environment.base;

  persona = null;
  evento = null;
  error = null;

  constructor(private route: ActivatedRoute,
              private personaService: PersonaService,
              private eventoService: EventoService) {
  }

  ngOnInit(): void {
    this.route.params.subscribe((param: Params) => {
      this.personaService.showPersonaInfo({
        idpersona: param.idpersona,
        idevento: param.idevento,
        carnet: param.carnetTres
      }).subscribe( (data: Persona) => {
        this.persona = data;
      }, () => {
        this.error = 'Persona no encontrada';
      });

      this.eventoService.showEvento(param.idevento).subscribe( (data: Evento) => {
        this.evento = data;
      });
    });
  }

}
