@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create Ticket</div>
                <div class="card-body">
                    @if($errors->getMessages())
                        <div class="alert alert-danger">
                            @foreach($errors->getMessages() as $errors)
                                <p class="mb-1">{{ $errors[0] }}</p>
                            @endforeach
                        </div>
                    @endif

                    <form method="POST" action="{{ route('dash.tickets.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group mb-3">
                            <label for="title">Título</label>
                            <input id="title" type="text" class="form-control" name="title" required autofocus
                                   value="{{ @old('title') }}">
                        </div>

                        <div class="form-group mb-3">
                            <label for="description">Descrição</label>
                            <textarea id="description" class="form-control" name="description"
                                      required>{{ @old('description') }}</textarea>
                        </div>

                        <div class="form-group mb-3">
                            <label for="attachment">Anexo</label>
                            <input id="attachment" type="file" class="form-control" name="attachment"
                                   value="{{ @old('attachment') }}">
                        </div>

                        <button type="submit" class="btn btn-primary">Abrir chamado</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
