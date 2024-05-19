<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTicketResponseRequest;
use App\Models\Ticket;
use App\Models\TicketResponse;

/**
 *
 */
class TicketResponseController extends Controller
{
    /**
     * @param StoreTicketResponseRequest $request
     * @param Ticket $ticket
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreTicketResponseRequest $request, Ticket $ticket)
    {
        $response = TicketResponse::create([
            'ticket_id' => $ticket->id,
            'user_id' => $this->user->id,
            'response' => $request->response,
            'status' => 'Em atendimento'
        ]);

        if (!$response) {
            return redirect()->route('dash.tickets.show', ['ticket'=> $ticket->id])
                ->with('error', 'Não foi possível adicionar resposta ao ticket')->withInput();
        }

        $ticket->update(['status' => 'Em atendimento']);

        return redirect()->route('dash.tickets.show', ['ticket'=> $ticket->id])
            ->with('success', 'Resposta adicionada com sucesso');
    }
}
