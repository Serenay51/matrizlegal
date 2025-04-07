<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Iniciar Sesión - SERLEG</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Estilos personalizados para video de fondo -->
    <style>
      body, html {
        height: 100%;
        margin: 0;
      }
      .video-bg {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        z-index: -1;
      }
      .overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: -1;
      }
      .content {
        position: relative;
        z-index: 1;
      }
    </style>
  </head>
  <body class="text-white">
    <!-- Video de fondo -->
    <video class="video-bg" autoplay loop muted playsinline>
      <source src="{{ asset('videos/background.mp4') }}" type="video/mp4">
      Tu navegador no soporta el video de fondo.
    </video>
    <div class="overlay"></div>
    
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container-fluid">
        <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
          <img src="{{ asset('images/serleg-icon.png') }}" alt="SERLEG Icon" width="30" height="30" class="d-inline-block align-text-top me-2">
          SERLEG
        </a>
      </div>
    </nav>
    
    <!-- Contenido principal -->
    <div class="container d-flex align-items-center justify-content-center content" style="height: 100vh;">
      <div class="card bg-dark text-white p-4" style="width: 100%; max-width: 400px; border-radius: 10px;">
        <div class="card-body">
          <h2 class="text-center mb-4">Iniciar Sesión</h2>

          <!-- Mensaje de sesión -->
          @if (session('status'))
            <div class="alert alert-success">
              {{ session('status') }}
            </div>
          @endif

          <!-- Formulario de login -->
          <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email -->
            <div class="mb-3">
              <label for="email" class="form-label">Correo Electrónico</label>
              <input id="email" type="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus autocomplete="username">
              @error('email')
                <div class="text-danger small mt-1">{{ $message }}</div>
              @enderror
            </div>

            <!-- Contraseña -->
            <div class="mb-3">
              <label for="password" class="form-label">Contraseña</label>
              <input id="password" type="password" name="password" class="form-control" required autocomplete="current-password">
              @error('password')
                <div class="text-danger small mt-1">{{ $message }}</div>
              @enderror
            </div>

            <!-- Recordarme -->
            <div class="form-check mb-3">
              <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
              <label class="form-check-label" for="remember_me">Recordarme</label>
            </div>

            <!-- Botón de inicio de sesión y enlace de recuperación -->
            <div class="d-flex justify-content-between align-items-center">
              @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-white text-decoration-none small">¿Olvidaste tu contraseña?</a>
              @endif
              <button type="submit" class="btn btn-primary">Ingresar</button>
            </div>
          </form>

          <!-- Botón para registrarse -->
          @if (Route::has('register'))
            <div class="text-center mt-4">
              <p class="mb-2">¿No estás suscripto?</p>
              <a href="{{ route('register') }}" class="btn btn-outline-light w-100">Registrarse</a>
            </div>
          @endif
        </div>
      </div>
    </div>
    
    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
