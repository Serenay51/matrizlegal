<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registro - SERLEG</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Estilos personalizados -->
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
      .hidden {
        display: none;
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
      <div class="card bg-dark text-white p-4" style="width: 100%; max-width: 450px; border-radius: 10px;">
        <div class="card-body">
          <h2 class="text-center mb-4">Registro</h2>

          <!-- Paso 2: Formulario de registro -->
          <form id="register-form" method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Nombre -->
            <div class="mb-3">
              <label for="name" class="form-label">Nombre</label>
              <input id="name" type="text" name="name" class="form-control" value="{{ old('name') }}" required autofocus autocomplete="name">
            </div>

            <!-- Email -->
            <div class="mb-3">
              <label for="email" class="form-label">Correo Electrónico</label>
              <input id="email" type="email" name="email" class="form-control" value="{{ old('email') }}" required autocomplete="username">
            </div>

            <!-- Contraseña -->
            <div class="mb-3">
              <label for="password" class="form-label">Contraseña</label>
              <input id="password" type="password" name="password" class="form-control" required autocomplete="new-password">
            </div>

            <!-- Confirmar contraseña -->
            <div class="mb-3">
              <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
              <input id="password_confirmation" type="password" name="password_confirmation" class="form-control" required autocomplete="new-password">
            </div>

            <!-- Botón de registro -->
            <button type="submit" class="btn btn-primary w-100">Registrarse</button>

            <!-- Enlace de inicio de sesión -->
            <div class="text-center mt-3">
              <p class="mb-2">¿Ya tienes cuenta?</p>
              <a href="{{ route('login') }}" class="btn btn-outline-light w-100">Iniciar Sesión</a>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  </body>
</html>
