@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Register</div>
                <div class="card-body">
                    @if($errors->getMessages())
                       <div class="alert alert-danger">
                           @foreach($errors->getMessages() as $errors)
                                   <p class="mb-1">{{ $errors[0] }}</p>
                           @endforeach
                       </div>
                    @endif

                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="name">Nome</label>
                            <input id="name" type="text" class="form-control" name="name" required autofocus
                                   value="{{ @old('name') }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="cpf">CPF</label>
                            <input id="cpf" type="text" class="form-control mask-cpf" name="cpf" required value="{{ @old('cpf') }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="email">Email</label>
                            <input id="email" type="email" class="form-control" name="email" required
                                   value="{{ @old('email') }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="password">Senha</label>
                            <input id="password" type="password" class="form-control" name="password" required
                                   value="{{ @old('password') }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="type">Tipo</label>
                            <select id="type" class="form-control" name="type" required>
                                <option value="">Escolha uma opção</option>
                                <option value="Cliente" @selected(old('type') == 'Cliente')>Cliente</option>
                                <option value="Colaborador" @selected(old('type') == 'Colaborador')>Colaborador</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Cadastrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
