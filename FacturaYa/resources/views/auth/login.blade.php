@extends('layouts.layoutAuth')

@section('content')
<div class="login-container">
    <div class="login-header">
        <svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="purple" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-book">
            <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
            <path d="M4 4.5A2.5 2.5 0 0 1 6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5z"></path>
        </svg>
        <h3>BIBLIOTECA</h3>
        <p class="text-muted">Inicia sesión en tu cuenta</p>
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf
        @method('POST')
        <div class="form-floating">
            <input type="email" class="form-control" id="emailInput" name="email" placeholder="nombre@ejemplo.com" required>
            <label for="emailInput">Correo electrónico</label>
            <div class="error-message">Por favor ingresa un correo válido</div>
        </div>

        <div class="form-floating">
            <input type="password" class="form-control" id="passwordInput" name="password" placeholder="Contraseña" required>
            <label for="passwordInput">Contraseña</label>
            <div class="error-message">La contraseña es requerida</div>
            
        </div>

        <div class="d-flex justify-content-end align-items-center">
            <a href="{{ route('password.request') }}" class="forgot-password">¿Olvidaste tu contraseña?</a>
        </div>


        <button type="submit" class="btn btn-login mt-3">Iniciar Sesión</button>
    </form>

    <div class="register-link">
        ¿No tienes una cuenta? <a href="{{ route('register') }}">Regístrate</a>
    </div>
</div>
@endsection