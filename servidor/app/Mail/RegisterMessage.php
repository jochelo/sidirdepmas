<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegisterMessage extends Mailable
{
    use Queueable, SerializesModels;

    protected $usuario;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->usuario = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.register-user')->with([
            'nombre' => $this->usuario->nombre_usuario,
            'cuenta' => $this->usuario->cuenta
        ]);
    }
}
