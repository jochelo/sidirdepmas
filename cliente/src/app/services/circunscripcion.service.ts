import { Injectable } from '@angular/core';
import {environment} from '../../environments/environment.prod';
import {HttpClient} from '@angular/common/http';
import {Observable} from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class CircunscripcionService {

  base = environment.base;

  constructor(private http: HttpClient) { }

  getCircunscripciones(): Observable<any> {
    return this.http.get(`${this.base}get-circunscripciones`);
  }
}
