<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TicketOpened extends Mailable
{
    use Queueable, SerializesModels;

    /** @var */
    protected $ticket;

    /** @param $ticket */
    public function __construct($ticket)
    {
        $this->ticket = $ticket;
    }

    /** @return TicketOpened */
    public function build()
    {
        return $this->subject("Novo Chamado Aberto de {$this->ticket->user->name}")
            ->view('emails.new-ticket', [
                'user' => $this->ticket->user,
                'ticket' => $this->ticket
            ]);
    }
}
