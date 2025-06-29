@extends('app')

@section('auth')
<div class="vh-100 d-flex align-items-center justify-content-center bg-gradient" style="background: linear-gradient(135deg, #4158D0 0%, #C850C0 46%, #FFCC70 100%);">
    <div class="col-12 col-sm-8 col-md-6 col-lg-4">
        <div class="card shadow-lg border-0 rounded-4">
            <div class="card-body p-5">
                <div class="text-center mb-4">
                    <img src="https://img.icons8.com/color/96/000000/key-security.png" alt="Reset" class="mb-3" style="width: 64px;">
                    <h2 class="fw-bold mb-1" style="background: linear-gradient(90deg, #C850C0, #FFCC70); -webkit-background-clip: text; color: transparent;">¡Restablece tu contraseña!</h2>
                    <p class="text-muted mb-0">Pon una nueva clave super segura</p>
                </div>
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf

                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="form-floating mb-3">
                        <input id="email" type="email"
                            class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ $email ?? old('email') }}" required autofocus placeholder="Correo electrónico">
                        <label for="email">Correo electrónico</label>
                        @error('email')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input id="password" type="password"
                            class="form-control @error('password') is-invalid @enderror"
                            name="password" required placeholder="Nueva contraseña">
                        <label for="password">Nueva contraseña</label>
                        @error('password')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-floating mb-4">
                        <input id="password-confirm" type="password"
                            class="form-control"
                            name="password_confirmation" required placeholder="Confirmar nueva contraseña">
                        <label for="password-confirm">Confirmar nueva contraseña</label>
                    </div>
                    <button type="submit" class="btn btn-lg btn-gradient w-100 mb-3" style="background: linear-gradient(90deg, #C850C0 0%, #FFCC70 100%); color: #fff; border: none;">
                        Restablecer contraseña 🔑
                    </button>
                    <div class="text-center">
                        <a class="small text-decoration-none" href="{{ route('home') }}">
                            ¿Ya la recordaste? Inicia sesión
                        </a>
                    </div>
                </form>
            </div>
        </div>
        <div class="text-center mt-4">
            <small class="text-light">© {{ date('Y') }} Stokity. Seguridad para tu cuenta.</small>
        </div>
    </div>
</div>
@endsection
