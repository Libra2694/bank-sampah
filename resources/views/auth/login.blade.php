@extends('layouts.auth')

@section('content')
    <div class="logo">
        <h1>🌱 Bank Sampah Digital</h1>
    </div>

    <h2 class="login-title">Login</h2>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <label for="email">Email</label>
        <input id="email" type="email" name="email" required autofocus>

        <label for="password">Password</label>
        <input id="password" type="password" name="password" required>

        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="remember" id="remember">
            <label for="remember">Remember Me</label>
        </div>

        <button type="submit" class="btn-primary">Login</button>

        <a class="btn-link" href="{{ route('password.request') }}">Forgot Password?</a>
    </form>
@endsection
