<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <title>YAAFO - Ensemble pour un quartier meilleur</title>
  <meta name="description" content="Plateforme communautaire YAAFO pour signaler et résoudre les problèmes locaux." />
  <meta name="keywords" content="alertes, communautaire, quartier, sécurité, environnement" />

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />

  <!-- Bootstrap CSS -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" rel="stylesheet" />

  <!-- AOS Animation -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet" />

  <!-- Leaflet CSS -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />

   <style>
    :root {
      --primary-color: #7c3aed;         /* Violet moderne */
      --secondary-color: #06b6d4;       /* Cyan vibrant */
      --accent-color: #10b981;          /* Emerald */
      --warning-color: #ffffff;         /* Amber */
      --danger-color: #f3f3f3;          /* Rouge corail */
      --dark-color: #0f172a;            /* Slate foncé */
      --light-color: #f8fafc;           /* Slate très clair */
      --neutral-color: #64748b;         /* Slate moyen */
      --border-radius: 16px;
      --shadow-soft: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.1);
      --shadow-hover: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
      --gradient-primary: linear-gradient(135deg, #7c3aed 0%, #06b6d4 100%);
      --gradient-secondary: linear-gradient(135deg, #10b981 0%, #059669 100%);
      --gradient-hero: linear-gradient(135deg, #2b2e4a 0%, #1f2233 100%);

    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Inter', sans-serif;
      line-height: 1.6;
      color: var(--dark-color);
      overflow-x: hidden;
    }

    /* Navigation moderne */
       .navbar {
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(10px);
      box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
      transition: all 0.3s ease;
    }

    .navbar-brand {
      font-family: 'Poppins', sans-serif;
      font-weight: 800;
      font-size: 1.8rem;
      background: var(--gradient-primary);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }

    .nav-link {
      font-weight: 500;
      color: var(--dark-color) !important;
      transition: all 0.3s ease;
      position: relative;
    }

    .nav-link:hover::after {
      content: '';
      position: absolute;
      bottom: -5px;
      left: 0;
      width: 100%;
      height: 3px;
      background: var(--gradient-primary);
      border-radius: 2px;
    }

    /* Hero Section améliorée */
    .hero {
      min-height: 100vh;
      background: var(--gradient-hero);
      position: relative;
      display: flex;
      align-items: center;
      overflow: hidden;
    }

    .hero::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: rgba(0, 0, 0, 0.3);
      z-index: 1;
    }

    .hero-content {
      position: relative;
      z-index: 2;
      color: white;
    }

    .hero h1 {
      font-family: 'Poppins', sans-serif;
      font-size: 4rem;
      font-weight: 800;
      margin-bottom: 1.5rem;
      text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
      background: white;
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }

    .hero-subtitle {
      font-size: 1.3rem;
      margin-bottom: 2rem;
      opacity: 0.9;
      color: #e2e8f0;
    }

    .btn-hero {
      padding: 1rem 2.5rem;
      border-radius: 50px;
      font-weight: 600;
      font-size: 1.1rem;
      transition: all 0.3s ease;
      border: none;
      text-decoration: none;
      display: inline-block;
      margin: 0.5rem;
      box-shadow: var(--shadow-soft);
    }

    .btn-primary-hero {
      background: var(--gradient-secondary);
      color: white;
    }

    .btn-primary-hero:hover {
      transform: translateY(-3px);
      box-shadow: var(--shadow-hover);
      color: white;
    }

    .btn-secondary-hero {
      background: transparent;
      color: white;
      border: 2px solid rgba(255, 255, 255, 0.8);
      backdrop-filter: blur(10px);
    }

    .btn-secondary-hero:hover {
      background: rgba(255, 255, 255, 0.15);
      color: white;
      border-color: white;
    }

    /* Statistiques flottantes */
    .stats-floating {
      position: absolute;
      bottom: 50px;
      left: 50%;
      transform: translateX(-50%);
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(10px);
      padding: 2rem;
      border-radius: var(--border-radius);
      border: 1px solid rgba(255, 255, 255, 0.2);
      z-index: 2;
    }

    .stat-item {
      text-align: center;
      color: white;
    }

    .stat-number {
      font-size: 2.5rem;
      font-weight: 800;
      background: linear-gradient(135deg, #10b981 0%, #06b6d4 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }

    /* Sections améliorées */
    .section {
      padding: 100px 0;
    }

    .section-title {
      text-align: center;
      margin-bottom: 4rem;
    }

    .section-title h2 {
      font-family: 'Poppins', sans-serif;
      font-size: 3rem;
      font-weight: 700;
      margin-bottom: 1rem;
      color: var(--dark-color);
    }

    .section-title p {
      font-size: 1.2rem;
      color: var(--neutral-color);
    }

    /* Cards de services */
    .service-card {
      background: white;
      border-radius: var(--border-radius);
      padding: 3rem 2rem;
      box-shadow: var(--shadow-soft);
      transition: all 0.3s ease;
      text-align: center;
      height: 100%;
      border: 1px solid rgba(0, 0, 0, 0.05);
    }

    .service-card:hover {
      transform: translateY(-10px);
      box-shadow: var(--shadow-hover);
    }

    .service-icon {
      width: 80px;
      height: 80px;
      margin: 0 auto 2rem;
      background: var(--gradient-primary);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 2rem;
      color: white;
      box-shadow: var(--shadow-soft);
    }

    .service-card h4 {
      font-family: 'Poppins', sans-serif;
      font-weight: 600;
      margin-bottom: 1rem;
      color: var(--dark-color);
    }

    /* Carte interactive */
    .map-section {
      background: var(--light-color);
    }

    #map {
      height: 600px;
      border-radius: var(--border-radius);
      box-shadow: var(--shadow-soft);
    }

    /* Cards d'alertes */
    .alert-card {
      background: white;
      border-radius: var(--border-radius);
      overflow: hidden;
      box-shadow: var(--shadow-soft);
      transition: all 0.3s ease;
      border: 1px solid rgba(0, 0, 0, 0.05);
    }

    .alert-card:hover {
      transform: translateY(-5px);
      box-shadow: var(--shadow-hover);
    }

    .alert-image {
      height: 200px;
      background-size: cover;
      background-position: center;
      position: relative;
    }

    .alert-status {
      position: absolute;
      top: 15px;
      right: 15px;
      padding: 0.5rem 1rem;
      border-radius: 20px;
      font-size: 0.9rem;
      font-weight: 600;
      color: white;
      backdrop-filter: blur(5px);
    }

    .status-attente { background: var(--warning-color); }
    .status-en-cours { background: var(--secondary-color); }
    .status-resolu { background: var(--accent-color); }

    .alert-content {
      padding: 1.5rem;
    }

    .alert-meta {
      display: flex;
      justify-content: space-between;
      margin-bottom: 1rem;
      color: var(--neutral-color);
      font-size: 0.9rem;
    }

    .alert-title {
      font-weight: 600;
      margin-bottom: 0.5rem;
      color: var(--dark-color);
    }

    /* CTA Section */
    .cta-section {
      background: var(--gradient-primary);
      color: white;
      position: relative;
      overflow: hidden;
    }

    .cta-section::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse"><path d="M 10 0 L 0 0 0 10" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="1"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>') repeat;
      opacity: 0.3;
    }

    /* Animations personnalisées */
    .floating {
      animation: floating 3s ease-in-out infinite;
    }

    @keyframes floating {
      0%, 100% { transform: translateY(0px); }
      50% { transform: translateY(-20px); }
    }

    .pulse {
      animation: pulse 2s infinite;
    }

    @keyframes pulse {
      0%, 100% { transform: scale(1); }
      50% { transform: scale(1.05); }
    }

    /* Responsive */
    @media (max-width: 768px) {
      .hero h1 {
        font-size: 2.5rem;
      }

      .hero-subtitle {
        font-size: 1.1rem;
      }

      .stats-floating {
        position: relative;
        bottom: auto;
        left: auto;
        transform: none;
        margin-top: 2rem;
      }

      .section-title h2 {
        font-size: 2rem;
      }
    }

    /* Effets de particules */
    .particles {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      overflow: hidden;
      z-index: 1;
    }

    .particle {
      position: absolute;
      background: rgba(255, 255, 255, 0.1);
      border-radius: 50%;
      animation: float 15s infinite linear;
    }

    @keyframes float {
      0% { transform: translateY(100vh) rotate(0deg); }
      100% { transform: translateY(-100vh) rotate(360deg); }
    }

    /* Custom scrollbar */
    ::-webkit-scrollbar {
      width: 8px;
    }

    ::-webkit-scrollbar-track {
      background: var(--light-color);
    }

    ::-webkit-scrollbar-thumb {
      background: var(--primary-color);
      border-radius: 4px;
    }

    ::-webkit-scrollbar-thumb:hover {
      background: var(--secondary-color);
    }
  </style>

</head>

<body>
  <!-- Navigation -->

@include('partials.header')
  <!-- Hero Section -->
  <section id="accueil" class="hero">
    <div class="particles">
      <div class="particle" style="left: 10%; width: 10px; height: 10px; animation-delay: 0s;"></div>
      <div class="particle" style="left: 20%; width: 20px; height: 20px; animation-delay: 2s;"></div>
      <div class="particle" style="left: 30%; width: 15px; height: 15px; animation-delay: 4s;"></div>
      <div class="particle" style="left: 40%; width: 8px; height: 8px; animation-delay: 6s;"></div>
      <div class="particle" style="left: 50%; width: 12px; height: 12px; animation-delay: 8s;"></div>
      <div class="particle" style="left: 60%; width: 18px; height: 18px; animation-delay: 10s;"></div>
      <div class="particle" style="left: 70%; width: 25px; height: 25px; animation-delay: 12s;"></div>
      <div class="particle" style="left: 80%; width: 14px; height: 14px; animation-delay: 14s;"></div>
      <div class="particle" style="left: 90%; width: 16px; height: 16px; animation-delay: 16s;"></div>
    </div>

    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-7 hero-content">
          <h1 data-aos="fade-up">Ensemble pour un quartier meilleur</h1>
          <p class="hero-subtitle" data-aos="fade-up" data-aos-delay="200">
            Signalez, suivez et résolvez les problèmes de votre communauté avec YAAFO.
            Une plateforme moderne qui rapproche les citoyens et les autorités.
          </p>
         <div class="hero-buttons" data-aos="fade-up" data-aos-delay="400">
  @guest
    <a href="{{ route('login') }}" class="btn-hero btn-primary-hero">
      <i class="bi bi-person-plus me-2"></i>Rejoindre la communauté
    </a>
    <a href="{{ route('login') }}" class="btn-hero btn-secondary-hero">
      <i class="bi bi-exclamation-triangle me-2"></i>Signaler un problème
    </a>
  @else
    <a href="{{ route('dashboard') }}" class="btn-hero btn-primary-hero">
      <i class="bi bi-speedometer2 me-2"></i>Mon tableau de bord
    </a>
    <a href="/commentsamarche" class="btn-hero btn-secondary-hero">
      <i class="bi bi-plus-circle me-2"></i>Créer une alerte
    </a>
  @endguest
</div>

        </div>
        <div class="col-lg-5 mb-5">
          <div class="hero-image floating" data-aos="fade-left" data-aos-delay="600">
            <div style="background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(10px); padding: 2rem; border-radius: 20px; text-align: center;">
              <i class="bi bi-shield-check" style="font-size: 5rem; color:  #059669;"></i>
              <h3 style="color: white; margin-top: 1rem;">Votre quartier, notre priorité</h3>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Statistiques flottantes -->
    <div class="stats-floating" data-aos="fade-up" data-aos-delay="800">
      <div class="row">
        <div class="col-md-4 stat-item">
          <div class="stat-number">2,547</div>
          <div>Alertes traitées</div>
        </div>
        <div class="col-md-4 stat-item">
          <div class="stat-number">89%</div>
          <div>Taux de résolution</div>
        </div>
        <div class="col-md-4 stat-item">
          <div class="stat-number">15,632</div>
          <div>Utilisateurs actifs</div>
        </div>
      </div>
    </div>
  </section>

  <!-- Services Section -->
  <section id="services" class="section">
    <div class="container">
      <div class="section-title" data-aos="fade-up">
        <h2>Comment ça marche ?</h2>
        <p>Trois étapes simples pour améliorer votre quartier</p>
      </div>

      <div class="row">
        <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="100">
          <div class="service-card">
            <div class="service-icon">
              <i class="bi bi-exclamation-triangle"></i>
            </div>
            <h4>1. Signalez</h4>
            <p>Décrivez le problème avec des photos et une localisation précise. Votre signalement est immédiatement transmis aux autorités compétentes.</p>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="200">
          <div class="service-card">
            <div class="service-icon">
              <i class="bi bi-eye"></i>
            </div>
            <h4>2. Suivez</h4>
            <p>Surveillez l'évolution de votre alerte en temps réel. Recevez des notifications à chaque étape du processus de résolution.</p>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="300">
          <div class="service-card">
            <div class="service-icon">
              <i class="bi bi-people"></i>
            </div>
            <h4>3. Partagez</h4>
            <p>Collaborez avec votre communauté pour résoudre les problèmes ensemble. Votre engagement fait la différence.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Carte Section -->
  <section id="carte" class="section map-section">
    <div class="container">
      <div class="section-title" data-aos="fade-up">
        <h2>Alertes en temps réel</h2>
        <p>Découvrez les signalements dans votre quartier</p>
      </div>

      <div class="row">
        <div class="col-12" data-aos="fade-up" data-aos-delay="200">
          <div id="map"></div>
        </div>
      </div>
    </div>
  </section>

  <!-- Alertes récentes -->
  <section id="alertes" class="section">
    <div class="container">
      <div class="section-title" data-aos="fade-up">
        <h2>Alertes récentes</h2>
        <p>Les derniers signalements de la communauté</p>
      </div>
       @if($alertes->isEmpty())
  <div class="text-center text-muted" data-aos="fade-up">
    <i class="bi bi-info-circle" style="font-size: 2rem;"></i>
    <p class="mt-3">Aucune alerte pour le moment. Soyez le premier à en créer une !</p>

    @auth
      <a href="{{ route('alertes.create') }}" class="btn btn-outline-primary">
        <i class="bi bi-plus-circle me-1"></i>Créer une alerte
      </a>
    @else
      <a href="{{ route('login') }}" class="btn btn-outline-secondary">
        <i class="bi bi-box-arrow-in-right me-1"></i>Connectez-vous pour signaler
      </a>
    @endauth
  </div>
@else
  <div class="row">
    @foreach ($alertes as $alerte)
      <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up">
        <div class="alert-card">
          <div class="alert-image" style="background-image: url('{{ $alerte->image ? asset('storage/'.$alerte->image) : 'https://via.placeholder.com/400x200' }}');">
            <div class="alert-status {{
              $alerte->status === 'attente' ? 'status-attente' :
              ($alerte->status === 'en_cours' ? 'status-en-cours' :
              'status-resolu')
            }}">
              {{ $alerte->status === 'attente' ? '🟠 En attente' : ($alerte->status === 'en_cours' ? '🔵 En cours' : '✅ Résolu') }}
            </div>
          </div>
          <div class="alert-content">
            <div class="alert-meta">
              <span><i class="bi bi-calendar"></i> {{ $alerte->created_at->format('d M Y') }}</span>
              <span><i class="bi bi-geo-alt"></i> {{ $alerte->quartier }}</span>
            </div>
            <h5 class="alert-title">{{ $alerte->title }}</h5>
            <p>{{ \Illuminate\Support\Str::limit($alerte->description, 100) }}</p>
          </div>
        </div>
      </div>
    @endforeach
  </div>
@endif

    </div>
  </section>
@include('partials.footer')
  <!-- CTA Section -->

  <!-- Scripts -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
  <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>
<script>
  // Initialize AOS
  AOS.init({
    duration: 1000,
    once: true,
    offset: 100
  });

  document.addEventListener('DOMContentLoaded', function () {
    var map = L.map('map').setView([14.6928, -17.4467], 13);

   L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
  attribution: 'Tiles © Esri — Source: Esri, i-cubed, USDA, USGS, AEX, GeoEye, etc.',
  maxZoom: 19
}).addTo(map);

    // Custom icons
    var icons = {
      attente: L.divIcon({
        html: '<div style="background: #f59e0b; width: 30px; height: 30px; border-radius: 50%; border: 3px solid white; box-shadow: 0 2px 10px rgba(0,0,0,0.3); display: flex; align-items: center; justify-content: center; font-size: 16px;">🟠</div>',
        iconSize: [30, 30],
        iconAnchor: [15, 15]
      }),
      en_cours: L.divIcon({
        html: '<div style="background: #2563eb; width: 30px; height: 30px; border-radius: 50%; border: 3px solid white; box-shadow: 0 2px 10px rgba(0,0,0,0.3); display: flex; align-items: center; justify-content: center; font-size: 16px;">🔵</div>',
        iconSize: [30, 30],
        iconAnchor: [15, 15]
      }),
      resolu: L.divIcon({
        html: '<div style="background: #10b981; width: 30px; height: 30px; border-radius: 50%; border: 3px solid white; box-shadow: 0 2px 10px rgba(0,0,0,0.3); display: flex; align-items: center; justify-content: center; font-size: 16px;">✅</div>',
        iconSize: [30, 30],
        iconAnchor: [15, 15]
      })
    };

    // Données des alertes injectées depuis Laravel
    var alertes = @json($alertesJs);

    // Ajout des marqueurs sur la carte
    alertes.forEach(function (alerte) {
      var popupContent = `
        <div style="padding: 10px; min-width: 200px;">
          <h6 style="margin: 0 0 10px 0; color: #1f2937;">${alerte.title}</h6>
          <p style="margin: 0 0 10px 0; font-size: 14px; color: #6b7280;">${alerte.description}</p>
          <div style="display: flex; justify-content: space-between; align-items: center;">
            <span style="font-size: 12px; color: #9ca3af;"><i class="bi bi-geo-alt"></i> ${alerte.quartier}</span>
            <span style="font-size: 12px; padding: 4px 8px; background: ${
              alerte.statut === 'attente' ? '#f59e0b' :
              alerte.statut === 'en_cours' ? '#2563eb' : '#10b981'
            }; color: white; border-radius: 12px;">
              ${alerte.statut === 'attente' ? '🟠 En attente' : alerte.statut === 'en_cours' ? '🔵 En cours' : '✅ Résolu'}
            </span>
          </div>
        </div>
      `;

      L.marker([alerte.lat, alerte.lng], { icon: icons[alerte.statut] || icons.attente })
        .addTo(map)
        .bindPopup(popupContent);
        console.log(alertes); // 👈 à ajouter

    });
  });

  // Smooth scroll
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
      e.preventDefault();
      const target = document.querySelector(this.getAttribute('href'));
      if (target) {
        target.scrollIntoView({
          behavior: 'smooth',
          block: 'start'
        });
      }
    });
  });

  // Navbar scroll effect
  window.addEventListener('scroll', function () {
    const navbar = document.querySelector('.navbar');
    if (window.scrollY > 50) {
      navbar.style.background = 'rgba(255, 255, 255, 0.98)';
    } else {
      navbar.style.background = 'rgba(255, 255, 255, 0.95)';
    }
  });
</script>



</body>
</html>
