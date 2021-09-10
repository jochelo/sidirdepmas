export class Observacion {
  constructor(
    public descripcion: string,
    public subsanado: boolean,
    public persona_id: number,
    public id?: number) {}
}
