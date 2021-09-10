export class Evento {
  constructor(
    public show: boolean,
    public lugar: string,
    public fecha_inicial: string,
    public fecha_final: string,
    public tipo: string,
    public nombre: string,
    public descripcion: string,
    public observacion: string,
    public activo: boolean,
    public archivo_adjunto: string,
    public ubicacion_id: number,
    public id?: number) {}
}
