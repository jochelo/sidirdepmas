<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ConfirmMessage extends Mailable
{
    use Queueable, SerializesModels;

    protected $usuario;
    protected $base;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, $base)
    {
        $this->usuario = $user;
        $this->base = $base;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.confirmation-code')->with([
            'nombre' => $this->usuario->nombres,
            'url' => $this->base . '/activate-acount/' . $this->usuario->confirmation_code
        ]);
    }
}
