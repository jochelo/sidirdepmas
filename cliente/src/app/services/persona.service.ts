import { Injectable } from '@angular/core';
import {environment} from '../../environments/environment.prod';
import {HttpClient} from '@angular/common/http';
import {Observable} from 'rxjs';
import {Persona} from '../models/persona';

@Injectable({
  providedIn: 'root'
})
export class PersonaService {

  base = environment.base;

  constructor(private http: HttpClient) {
  }

  getPersonas(): Observable<any> {
    return this.http.get(`${this.base}get-personas`);
  }

  paginatePersonas(data: any): Observable<any> {
    return this.http.post(`${this.base}paginate-personas`, data);
  }

  storePersona(data: any): Observable<any> {
    return this.http.post(`${this.base}store-persona`, data);
  }

  showPersona(idpersona: number, idevento: number): Observable<any> {
    return this.http.get(`${this.base}show-persona/${idpersona}/${idevento}`);
  }

  showPersonaInfo(data: any): Observable<any> {
    return this.http.post(`${this.base}show-persona-info`, {data});
  }

  showInscritosEvento(idevento: number): Observable<any> {
    return this.http.get(`${this.base}show-inscritos-evento/${idevento}`);
  }

  updatePersona(data: any): Observable<any> {
    return this.http.post(`${this.base}update-persona`, data);
  }

  deletePersona(idpersona: number): Observable<any> {
    return this.http.delete(`${this.base}delete-persona/${idpersona}`);
  }

  aprobar(idpersona: number, idevento: number): Observable<any> {
    return this.http.get(`${this.base}aprobar-persona/${idpersona}/${idevento}`);
  }

  rechazar(idpersona: number, idevento: number): Observable<any> {
    return this.http.get(`${this.base}rechazar-persona/${idpersona}/${idevento}`);
  }

  saveCargo(cargo: string, idpersona: number, idevento: number): Observable<any> {
    return this.http.post(`${this.base}save-cargo-persona-evento/${idpersona}/${idevento}`, {cargo});
  }

  saveObservacionEvento(observacion: string, idpersona: number, idevento: number): Observable<any> {
    return this.http.post(`${this.base}save-observacion-persona-evento/${idpersona}/${idevento}`, {observacion});
  }

  saveTitular(persona: Persona | any, idpersona: number, idevento: number): Observable<any> {
    console.log(persona);
    return this.http.post(`${this.base}save-titular-persona-evento/${idpersona}/${idevento}`, {persona});
  }

  storeObservacionPersona(data: any, idpersona: number, idevento: number): Observable<any> {
    return this.http.post(`${this.base}store-observacion-persona/${idpersona}/${idevento}`, {observacion: data});
  }
}
