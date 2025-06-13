@extends('app')

@section('auth')
<div class="vh-100 d-flex align-items-center justify-content-center bg-gradient" style="background: linear-gradient(135deg, #4158D0 0%, #C850C0 46%, #FFCC70 100%);">
    <div class="col-12 col-sm-8 col-md-6 col-lg-4">
        <div class="card shadow-lg border-0 rounded-4">
            <div class="card-body p-5">
                <div class="text-center mb-4">
                    <img src="https://img.icons8.com/color/96/000000/forgot-password.png" alt="Forgot Password" class="mb-3" style="width: 64px;">
                    <h2 class="fw-bold mb-1" style="background: linear-gradient(90deg, #C850C0, #FFCC70); -webkit-background-clip: text; color: transparent;">¿Olvidaste tu contraseña?</h2>
                    <p class="text-muted mb-0">Recupera el acceso a tu cuenta MegaWow</p>
                </div>

                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="form-floating mb-4">
                        <input id="email" type="email"
                            class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autofocus placeholder="Correo electrónico">
                        <label for="email">Correo electrónico</label>
                        @error('email')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-lg btn-gradient w-100 mb-3" style="background: linear-gradient(90deg, #C850C0 0%, #FFCC70 100%); color: #fff; border: none;">
                        Enviar enlace de recuperación 🔒
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
            <small class="text-light">© {{ date('Y') }} TuApp MegaWow. Recupera tu acceso fácil y seguro.</small>
        </div>
    </div>
</div>
@endsection