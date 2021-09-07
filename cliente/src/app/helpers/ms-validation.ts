export const validationMessages = {
  cuenta: [
    {type: 'required', message: 'Cuenta es requerido'},
    {type: 'minlength', message: 'La Cuenta debe tener al menos 5 caracteres'},
    {type: 'maxlength', message: 'La Cuenta no puede tener mas de 20 caracteres'},
    {type: 'pattern', message: 'La cuenta debe contener solo números y letras'},
    {type: 'validCuenta', message: 'Tu cuenta ya ha sido registrada por otro usuario'}
  ],
  name: [
    {type: 'required', message: 'Este campo es requerido'},
    {type: 'minlength', message: 'Este campo debe tener al menos 2 caracteres'},
    {type: 'maxlength', message: 'Este campo no puede tener mas de 30 caracteres'},
    {type: 'pattern', message: 'Solo puede tener letras'}
  ],
  email: [
    {type: 'required', message: 'El correo es requerido'},
    {type: 'pattern', message: 'Ingrese un correo valido'},
    {type: 'validEmail', message: 'Tu email ya ha sido registrado por otro usuario'}
  ],
  confirm_password: [
    {type: 'required', message: 'Confirmar contraseña es requerido'},
    {type: 'areEqual', message: 'Contraseña no coincide'}
  ],
  password: [
    {type: 'required', message: 'Contraseña es requerida'},
    {type: 'minlength', message: 'La contraseña debe tener al menos 5 caracteres'},
    {type: 'pattern', message: 'Su contraseña debe contener al menos alguna mayúscula, alguna minúscula y algun número'}
  ],
  date: [
    {type: 'required', message: 'La Fecha es requerida'},
    {type: 'pattern', message: 'Ingrese una fecha valida'},
  ],
  carnet: [
    {type: 'required', message: 'El número de carnet es requerido'},
    {type: 'minlength', message: 'El número de carnet debe tener al menos 5 caracteres'},
    {type: 'maxlength', message: 'El número de carnet no puede tener mas de 11 caracteres'},
    {type: 'pattern', message: 'Ingrese un número de carnet valido'}
  ],
  exp: [
    {type: 'required', message: 'la expedición del carnet es requerida'}
  ],
  ext: [
    {type: 'required', message: 'la extensión del carnet es requerida'},
    {type: 'maxlength', message: 'La extensión del carnet no puede tener mas de 3 caracteres'}
  ],
  img: [
    {type: 'required', message: 'la imagen es requerida'}
  ],
  circunscripcion: [
    {type: 'required', message: 'la circunscripción es requerida'}
  ],
  direccion: [
    {type: 'required', message: 'la dirección es requerida'}
  ],
  localidad: [
    {type: 'required', message: 'la localidad es requerida'}
  ],
  terms: [
    {type: 'pattern', message: 'You must accept terms and conditions'}
  ],
  gestionMilitancia: [
    {type: 'required', message: 'Este campo es requerido'},
    {type: 'minLength', message: 'Este campo debe tener al menos 4 digitos'},
    {type: 'maxLength', message: 'Este campo no puede tener mas de 4 digitos'},
  ],
};
