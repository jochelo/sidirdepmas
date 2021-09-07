import { Injectable } from '@angular/core';
import {HttpClient} from '@angular/common/http';
import {environment} from '../../environments/environment.prod';
import {Observable} from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class UbicacionService {

  base = environment.base;

  constructor(private http: HttpClient) { }

  getLocalidades(circunscripcionId: number): Observable<any> {
    return this.http.get(`${this.base}get-localidades-circunscripcion/${circunscripcionId}`);
  }
}
