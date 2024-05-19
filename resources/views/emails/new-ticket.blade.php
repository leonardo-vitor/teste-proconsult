<h1>Um novo chamado foi aberto</h1>

<p>Cliente: {{ $user->name }}</p>
<p>Data: {{ $ticket->created_at->format('d/m/Y H:i') }}</p>

<p>Por favor, acesse a <a href="{{ route('dash.tickets') }}">plataforma</a> para mais detalhes.</p>
