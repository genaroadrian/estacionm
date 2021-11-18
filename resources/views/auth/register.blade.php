@extends('layouts.auth')

@section('content')
<div class="cont">
    <div class="demo">

        <div class="login">
            <img width="65%" src="https://iconarchive.com/download/i89287/icons8/ios7/Weather-Partly-Cloudy-Rain.ico" alt="login" class="logo">
            <form class="login__form" method="POST" action="{{ route('register') }}">
                @csrf
                <div class="login__row @error('name') is-invalid @enderror">
                    <svg class="login__icon name svg-icon" viewBox="0 0 20 20">
                        <path d="M0,20 a10,8 0 0,1 20,0z M10,0 a4,4 0 0,1 0,8 a4,4 0 0,1 0,-8" />
                    </svg>
                    <input id="name" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus
                        type="text" class="login__input name" placeholder="Nombre completo" />
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="login__row @error('email') is-invalid @enderror">
                    <svg class="login__icon name svg-icon" viewBox="0 0 20 20">
                        <path d="M0,20 a10,8 0 0,1 20,0z M10,0 a4,4 0 0,1 0,8 a4,4 0 0,1 0,-8" />
                    </svg>
                    <input id="email" name="email" value="{{ old('email') }}" required autocomplete="email"
                        type="text" class="login__input name" placeholder="Correo electronico" />
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="login__row @error('password') is-invalid @enderror">
                    <svg class="login__icon pass svg-icon" viewBox="0 0 20 20">
                        <path d="M0,20 20,20 20,8 0,8z M10,13 10,16z M4,8 a6,8 0 0,1 12,0" />
                    </svg>
                    <input type="password" id="password" name="password" autocomplete="new-password" required
                        class="login__input pass" placeholder="Contraseña" />
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="login__row">
                    <svg class="login__icon pass svg-icon" viewBox="0 0 20 20">
                        <path d="M0,20 20,20 20,8 0,8z M10,13 10,16z M4,8 a6,8 0 0,1 12,0" />
                    </svg>
                    <input type="password" id="password-confirm" name="password_confirmation" autocomplete="new-password" required
                        class="login__input pass" placeholder="Confirmar ontraseña" />
                </div>
                <button type="submit" class="login__submit">Registrarme</button>
                <p class="login__signup">¿Ya tienes una cuenta? &nbsp;<a href=" {{route('login')}} ">Iniciar Sesión</a></p>
            </form>
        </div>

    </div>
</div>
@endsection

@section('css')
<style>
    .login__form {
        top: 31%
    }

    .logo {
        display: block;
        margin: auto;
    }
</style>
@endsection