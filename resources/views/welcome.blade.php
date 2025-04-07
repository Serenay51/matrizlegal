<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SERLEG - Matriz Legal</title>
    
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
    
    <!-- Navbar con botones de autenticación -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container-fluid">
        <a class="navbar-brand d-flex align-items-center" href="#">
          <img src="{{ asset('images/serleg-icon.png') }}" alt="SERLEG Icon " width="30" height="30" class="d-inline-block align-text-top me-3">
          SERLEG
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" 
                aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarContent">
          @if (Route::has('login'))
            <ul class="navbar-nav mb-2 mb-lg-0">
              @auth
                <li class="nav-item">
                  <a href="{{ url('/dashboard') }}" class="nav-link">Dashboard</a>
                </li>
              @else
                <li class="nav-item">
                  <a href="{{ route('login') }}" class="nav-link">Iniciar sesión</a>
                </li>
                @if (Route::has('register'))
                  <li class="nav-item">
                    <a href="{{ route('register') }}" class="nav-link">Registrarse</a>
                  </li>
                @endif
              @endauth
            </ul>
          @endif
        </div>
      </div>
    </nav>
    
    <!-- Contenido principal -->
    <div class="container d-flex align-items-center justify-content-center content" style="height: 100vh;">
      <div class="text-center">
        <h1 class="display-4 fw-bold">Bienvenido a SERLEG</h1>
        <p class="lead my-4">
          Tu matriz legal para encontrar leyes a nivel Nacional, Provincial, Ciudad Autónoma de Buenos Aires y La Matanza.
        </p>
        <p class="mb-4">
          Explora y busca la legislación que necesitas. Contribuye recomendandonos nuevas leyes para nuestra base de datos y asi mantener la información actualizada.
        </p>
        <!-- Aquí podrías agregar un buscador o enlaces adicionales según tus necesidades -->
      </div>
    </div>
    
    
    <!-- Bootstrap 5 JS Bundle (incluye Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
