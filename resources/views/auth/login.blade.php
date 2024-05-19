@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-12 col-md-6 col-lg-4 col-xl-3">
            <div class="card">
                <div class="card-header">Login</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('login.do') }}">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="email">Email</label>
                            <input id="email" type="email" class="form-control" name="email" required autofocus
                                   value="{{@old('email')}}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="password">Password</label>
                            <input id="password" type="password" class="form-control" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Entrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
