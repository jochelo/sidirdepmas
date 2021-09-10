@component('mail::message')
<div style="text-align: center">
<img src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/41/Movimiento_al_Socialismo_%E2%80%93_Instrumento_Pol%C3%ADtico_por_la_Soberan%C3%ADa_de_los_Pueblos.svg/1200px-Movimiento_al_Socialismo_%E2%80%93_Instrumento_Pol%C3%ADtico_por_la_Soberan%C3%ADa_de_los_Pueblos.svg.png" width="200px">
</div>
<h1 style="text-align: center">Registro Exitoso</h1>
<p style="text-align: center">Hola {{ $nombre }} Gracias por registrarte. Por favor espera a que nuestros operarios validen tu registro.</p>
<p>Recuerda las credenciales que registraste, con ellas accederas al sistema.</p>
<p><b>Cuenta: </b><em>{{ $cuenta }}</em></p>
<p><b>Contraseña: </b><em>*Esta información esta oculta por seguridad*</em></p>
<small>Gracias {{ $nombre }},  Atte: {{ config('app.name') }}</small>
@endcomponent
