@php
    use Illuminate\Support\Facades\Auth;
    $isAuthPage = request()->routeIs('login') || request()->routeIs('register') || request()->routeIs('user.register');
@endphp

<header id="header" class="header d-flex align-items-center fixed-top {{ $isAuthPage ? 'bg-white border-bottom' : '' }}" style="{{ $isAuthPage ? 'min-height: 60px;' : '' }}">
  <div class="container-fluid container-xl d-flex align-items-center justify-content-between py-2">

    <!-- Logo -->
    <a href="{{ url('/') }}" class="logo d-flex align-items-center">
      <h1 class="sitename mb-0 {{ $isAuthPage ? 'text-primary' : '' }}">YAAFO</h1>
    </a>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg fixed-top">
      <div class="container">
        <a class="navbar-brand" href="/"><i class="bi bi-shield-check me-2"></i>YAAFO</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a class="nav-link" href="/">Accueil</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/commentsamarche">Services</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/cartesdesalertes">Alertes</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#contact">Contact</a>
            </li>

            @if(Auth::check())
              <li class="nav-item">
                <a href="{{ route('dashboard') }}" class="btn btn-primary rounded-pill px-3 me-2">Tableau de bord</a>
              </li>
              <li class="nav-item">
                <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <button type="submit" class="btn btn-outline-danger rounded-pill px-3">Déconnexion</button>
                </form>
              </li>
            @else
              <li>
                <a href="{{ route('login') }}" class="btn btn-outline-success rounded-pill px-3">Connexion</a>
                <a href="{{ route('user.register') }}" class="btn btn-outline-success rounded-pill px-3">s'inscrire</a>
              </li>
            @endif

          </ul>
        </div>
      </div>
    </nav>

  </div>
</header>
