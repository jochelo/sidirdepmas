import {Observacion} from './observacion';

export class Persona {
  constructor(
    public show: boolean,
    public change: boolean,
    public changeObservacionEvento: boolean,
    public nombres: string,
    public apellido_paterno: string,
    public apellido_materno: string,
    public nombre_completo: string,
    public fecha_nacimiento: string,
    public carnet: string,
    public extension_carnet: string,
    public expedicion_carnet: string,
    public imgcian: string,
    public imgcirev: string,
    public sexo: string,
    public observaciones: Observacion[],
    public estado?: string,
    public cargo?: string,
    public titular?: boolean,
    public observacion_evento?: string,
    public anio_militancia?: number,
    public foto_filename?: string,
    public circunscripcion_codigo?: string,
    public id?: number) {}
}
