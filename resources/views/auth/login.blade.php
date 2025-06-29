@extends('app')

@section('auth')
<div class="vh-100 d-flex align-items-center justify-content-center"
     style="background: url('{{ asset('plantilla/back.png') }}'); background-size: cover; background-position: center;">
    <div class="col-12 col-sm-8 col-md-6 col-lg-4">
        <div class="card shadow-lg border-0 rounded-4">
            <div class="card-body p-5">
                <div class="text-center mb-4">
                    <img src="https://img.icons8.com/color/96/000000/rocket--v1.png" alt="Logo" class="mb-3" style="width: 64px;">
                    <h2 class="fw-bold mb-1" style="background: linear-gradient(90deg, #C850C0, #FFCC70); -webkit-background-clip: text; color: transparent;">¡Ingresa al sistema!</h2>
                    <p class="text-muted mb-0">Accede con tu cuenta super wow</p>
                </div>
                @if (session('status'))
                <div class="alert alert-danger" role="alert">
                    {{ session('status') }}
                </div>
                @endif
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-floating mb-3">
                        <input id="email" type="email"
                            class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autofocus
                            placeholder="name@example.com">
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
                            name="password" required placeholder="Contraseña">
                        <label for="password">Contraseña</label>
                        @error('password')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <!-- <div class="mb-3 form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">
                            Recordarme
                        </label>
                    </div> -->
                    <button type="submit" class="btn btn-lg btn-gradient w-100 mb-3" style="background: linear-gradient(90deg, #C850C0 0%, #FFCC70 100%); color: #fff; border: none;">
                        Iniciar sesión 🚀
                    </button>
                    <!-- <div class="d-flex justify-content-between">
                        @if (Route::has('password.email'))
                        <a class="small text-decoration-none" href="{{ route('auth.password.email') }}">
                            ¿Olvidaste tu contraseña?
                        </a>
                        @endif
                        <a class="small text-decoration-none" href="{{ route('auth.register') }}">
                            ¿No tienes cuenta?
                        </a>
                    </div> -->
                </form>
            </div>
        </div>
        <div class="text-center mt-4">
            <small class="text-light">© {{ date('Y') }} Stokity. MegaWow.</small>
        </div>
    </div>
</div>
@endsection
