@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="main">
            <div class="container a-container" id="a-container">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <h2 class="form_title title">Iniciar sesión</h2>
                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control form__input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Correo electrónico">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control form__input @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Contraseña">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <button class="form__button button submit">Iniciar sesión</button>
                </form>
            </div>
            <div class="switch" id="switch-cnt">
                <div class="switch__circle"></div>
                <div class="switch__circle switch__circle--t"></div>
                <div class="switch__container" id="switch-c1">
                    <h2 class="switch__title title">Hola!</h2>
                    <p class="switch__description description">Regístrate ya y trabaja con nosotros</p>
                    <a class="switch__button button switch-btn" href="{{route('register')}}">Regístrate</a>
                </div>
            </div>
        </div>
    </div>
@endsection
