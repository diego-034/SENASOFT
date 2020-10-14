@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="main">
            <div class="container a-container" id="a-container">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <h2 class="form_title title">Crear cuenta</h2>
                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control form__input @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Nombre">

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control form__input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Correo electrónico">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control form__input @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Contraseña">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <input id="password-confirm" type="password" class="form-control form__input" name="password_confirmation" required autocomplete="new-password" placeholder="Confirmar contraseña">
                    </div>
                    <button class="form__button button submit">Crear cuenta</button>
                </form>
            </div>
            <div class="switch" id="switch-cnt">
                <div class="switch__circle"></div>
                <div class="switch__circle switch__circle--t"></div>
                <div class="switch__container" id="switch-c1">
                    <h2 class="switch__title title">¡Bienvenido!</h2>
                    <p class="switch__description description">Para mantenerse conectado con nosotros, inicie sesión con su información personal</p>
                    <a href="{{route('login')}}" class="switch__button button switch-btn">Iniciar sesión</a>
                </div>
            </div>
        </div>
    </div>
@endsection
