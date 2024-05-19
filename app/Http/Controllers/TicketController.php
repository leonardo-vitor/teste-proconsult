<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTicketRequest;
use App\Mail\TicketOpened;
use App\Models\Ticket;
use App\Models\TicketResponse;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class TicketController extends Controller
{
    /**
     * @return View
     */
    public function index(): view
    {
        $user = auth()->user();
        $query = Ticket::query();

        if ($user->type == 'Cliente') {
            $query->where('user_id', $user->id);
        }

        $tickets = $query->orderBy('created_at', 'desc')->paginate(6);

        return view('dashboard.index', compact('tickets'));
    }

    /**
     * @return View|RedirectResponse
     */
    public function create(): view|RedirectResponse
    {
        if (Gate::denies('create', Ticket::class)) {
            return redirect()->route('dash.tickets')->with('error', 'Acesso não autorizado');
        }

        return view('dashboard.create');
    }

    /**
     * @param StoreTicketRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreTicketRequest $request): RedirectResponse
    {
        if (Gate::denies('create', Ticket::class)) {
            return redirect()->route('dash.tickets')->with('error', 'Acesso não autorizado');
        }

        $ticket = new Ticket();
        $ticket->title = $request->get('title');
        $ticket->description = $request->get('description');
        $ticket->user_id = $this->user->id;

        if ($request->hasFile('attachment')) {
            $fileName = uniqid('', true) . '.' . $request->file('attachment')->getClientOriginalName();
            $ticket->attachment = $request->file('attachment')->storeAs('attachments', $fileName);
        }

        if (!$ticket->save()) {
            return redirect()->route('register')->with('error', 'Usuário cadastrado com sucesso!')->withInput();
        }

        $collaborators = User::where('type', 'Colaborador')->get();
        foreach ($collaborators as $collaborator) {
            Mail::to($collaborator->email)->send(new TicketOpened($ticket));
        }

        return redirect()->route('dash.tickets')->with('success', 'Chamado aberto com sucesso');
    }


    /**
     * @param Ticket $ticket
     * @return View
     */
    public function show(Ticket $ticket): view
    {
        return view('dashboard.show', compact('ticket'));
    }

    /**
     * @param Ticket $ticket
     * @return \Illuminate\Http\RedirectResponse
     */
    public function finalize(Ticket $ticket): RedirectResponse
    {
        if (Gate::denies('update', TicketResponse::class)) {
            return redirect()->route('dash.tickets')->with('error', 'Acesso não autorizado');
        }

        if (auth()->user()->type != 'Colaborador') {
            return redirect()->back()->with('error', 'Unauthorized');
        }

        $ticket->update(['status' => 'Finalizado']);

        return redirect()->route('dash.tickets.show', $ticket->id)->with('success', 'Chamado finalizado com sucesso');
    }
}
