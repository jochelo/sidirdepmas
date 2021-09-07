export class Usuario {
  constructor(
    public cuenta: string,
    public password: string,
    public email: string,
    public confirmed: boolean,
    public confirmation_code: string,
    public email_verified_at: string,
    public foto: string,
    public rol_id: number,
    public nombre_usuario?: string,
    public avatar?: string,
    public autorizado?: boolean,
    public id?: number) {}
}
