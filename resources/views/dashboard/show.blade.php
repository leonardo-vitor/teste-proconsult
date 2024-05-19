@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6 col-xl-4">
            <div class="card">
                <div class="card-header">Ticket: [#{{ $ticket->id }}] {{ $ticket->title }}</div>
                <div class="card-body px-6">
                    <p class="mb-1"><strong>Status:</strong> {{ $ticket->status }}</p>
                    <p class="mb-1"><strong>Description:</strong> {{ $ticket->description }}</p>
                    @if($ticket->attachment)
                        <p class="mb-1">
                            <strong>Anexo:</strong> <a href="{{ asset('storage/'.$ticket->attachment) }}" download>
                                Download
                            </a>
                        </p>
                    @endif
                    <p class="mb-1"><strong>Aberto em:</strong> {{ $ticket->created_at->format('d/m/Y h:m') }}</p>
                    <p class="mb-1"><strong>Atualizado em:</strong> {{ $ticket->updated_at->format('d/m/Y h:m') }}</p>
                    <hr>

                    <h5>Responses</h5>

                    @if($ticket->responses->isEmpty())
                        <p>Sem respostas</p>
                    @else
                        @foreach($ticket->responses as $id => $response)
                            <div class="card mb-2 border-0 rounded-0 border-bottom">
                                <div class="card-body p-1">
                                    <p class="m-0">{{ $response->response }}</p>
                                    <p class="m-0 text-secondary" style="font-size: .95rem;">
                                        <small>
                                            <strong>Respondido por:</strong> {{ $response->user->name }} |
                                            {{ $response->created_at->format('d/m/Y H:i') }}
                                        </small>
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    @endif

                    @if($ticket->status !== 'Finalizado')
                        @if(auth()->user()->type !== 'Cliente' || !$ticket->responses->isEmpty())
                            <form method="POST" action="{{ route('dash.response.store', ['ticket' => $ticket->id]) }}">
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="response" class="mb-1">Resposta</label>
                                    <textarea id="response" class="form-control" name="response"
                                              required>{{@old('response')}}</textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Responder</button>
                            </form>
                        @endif

                        @if(auth()->user()->type == 'Colaborador')
                            <hr>
                            <form method="POST" action="{{ route('dash.tickets.finalize', ['ticket' => $ticket]) }}"
                                  class="row">
                                @csrf
                                <div class="col-12">
                                    <button type="submit" class="btn btn-danger w-100">Encerrar chamado</button>
                                </div>
                            </form>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
