@extends('layouts.layoutAuth')

@section('content')
<div class="login-container">
    <div class="login-header">
        <svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="purple" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-book">
            <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
            <path d="M4 4.5A2.5 2.5 0 0 1 6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5z"></path>
        </svg>
        <h3>BIBLIOTECA</h3>
        <p class="text-muted">Confirma tu contraseña antes de continuar</p>
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf
        @method('POST')
        <div class="form-floating">
            <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña" required>
            <label for="password">Contraseña</label>
            <div class="error-message">La contraseña es requerida</div>
        </div>

        <button type="submit" class="btn btn-login mt-3">Confirmar</button>
    </form>
</div>
@endsection
