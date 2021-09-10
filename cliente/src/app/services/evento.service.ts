import { Injectable } from '@angular/core';
import {environment} from '../../environments/environment.prod';
import {HttpClient} from '@angular/common/http';
import {Observable} from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class EventoService {

  base = environment.base;

  constructor(private http: HttpClient) {
  }

  getEventos(): Observable<any> {
    return this.http.get(`${this.base}get-eventos`);
  }

  paginateEventos(data: any): Observable<any> {
    return this.http.post(`${this.base}paginate-eventos`, data);
  }

  storeEvento(data: any): Observable<any> {
    return this.http.post(`${this.base}store-evento`, data);
  }

  showEvento(idevento: number): Observable<any> {
    return this.http.get(`${this.base}show-evento/${idevento}`);
  }

  updateEvento(data: any): Observable<any> {
    return this.http.post(`${this.base}update-evento`, data);
  }

  deleteEvento(idevento: number): Observable<any> {
    return this.http.delete(`${this.base}delete-evento/${idevento}`);
  }
}
