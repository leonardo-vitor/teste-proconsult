@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Tickets</div>
                <div class="card-body">
                    @if(auth()->user()->type == 'Cliente')
                        <div class="text-end">
                            <a href="{{ route('dash.tickets.create') }}" class="btn btn-primary btn-outline mb-3">
                                Abrir chamado
                            </a>
                        </div>
                    @endif

                    @if($tickets->isEmpty())
                        <div class="alert alert-info">
                            <p class="mb-0">Não há tickets abertos.</p>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover table-striped">
                                <thead>
                                <tr class="text-center">
                                    <th>Título</th>
                                    <th>Status</th>
                                    <th>Data de abertura</th>
                                    <th>Anexo</th>
                                    <th>#</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($tickets as $ticket)
                                    <tr class="text-center">
                                        <td class="text-start">{{ $ticket->title }}</td>
                                        <td>{{ $ticket->status }}</td>
                                        <td>{{ $ticket->created_at->format('d/m/Y H:i') }}</td>
                                        <td>
                                            @if($ticket->attachment)
                                                <i class="bi bi-check-square-fill text-primary"></i>
                                            @else
                                                <i class="bi bi-square text-secondary"></i>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('dash.tickets.show', $ticket->id) }}"
                                               class="btn btn-info btn-sm">Visualizar</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        {{ $tickets->links() }}
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
