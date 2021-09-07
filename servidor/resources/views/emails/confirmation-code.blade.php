@component('mail::message')
<div style="text-align: center">
<img src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/41/Movimiento_al_Socialismo_%E2%80%93_Instrumento_Pol%C3%ADtico_por_la_Soberan%C3%ADa_de_los_Pueblos.svg/1200px-Movimiento_al_Socialismo_%E2%80%93_Instrumento_Pol%C3%ADtico_por_la_Soberan%C3%ADa_de_los_Pueblos.svg.png" width="200px">
</div>
<h1 style="text-align: center">Confirma tu correo electrónico</h1>
<p style="text-align: center">Hola {{ $nombre }} Gracias por registrarte. Para acceder a tu cuenta y tener acceso a todas las operaciones necesarias, haz clic en el boton verde.</p>

@component('mail::button', ['url' => $url, 'color' => 'success'])
Confirmar mi cuenta
@endcomponent

@component('mail::panel')
¿No funciona el boton? Prueba con el siguiente enlace: <a href="{{ $url }}">{{ $url }}</a>
@endcomponent

<small>Gracias, {{ config('app.name') }}</small>
@endcomponent
