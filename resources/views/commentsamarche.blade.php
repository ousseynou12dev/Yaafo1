<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <title>Comment ça marche - YAAFO</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" rel="stylesheet" />
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
      background-color: var(--light-color);
      color: var(--dark-color);
      line-height: 1.6;
    }

    .hero {
      min-height: 70vh;
      background: var(--gradient-primary);
      color: white;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 80px 0;
      text-align: center;
      position: relative;
      overflow: hidden;
    }

    .hero::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="rgba(255,255,255,0.1)" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,154.7C960,171,1056,181,1152,170.7C1248,160,1344,128,1392,112L1440,96L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>') no-repeat bottom center;
      background-size: cover;
    }

    .hero-content {
      position: relative;
      z-index: 2;
    }

    .hero h1 {
      font-size: 3.5rem;
      font-weight: 800;
      margin-bottom: 1.5rem;
      text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
      animation: fadeInUp 1s ease-out;
    }

    .hero p {
      font-size: 1.3rem;
      margin-bottom: 2rem;
      opacity: 0.9;
      animation: fadeInUp 1s ease-out 0.3s both;
    }

    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(30px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .section-title {
      text-align: center;
      margin-bottom: 4rem;
    }

    .section-title h2 {
      font-family: 'Poppins', sans-serif;
      font-weight: 700;
      font-size: 2.5rem;
      color: var(--dark-color);
      margin-bottom: 1rem;
      position: relative;
    }

    .section-title h2::after {
      content: '';
      position: absolute;
      bottom: -10px;
      left: 50%;
      transform: translateX(-50%);
      width: 80px;
      height: 4px;
      background: var(--gradient-primary);
      border-radius: 2px;
    }

    .section-title p {
      font-size: 1.1rem;
      color: #6b7280;
      max-width: 600px;
      margin: 0 auto;
    }

    .service-card {
      background: white;
      border-radius: var(--border-radius);
      padding: 3rem 2rem;
      box-shadow: var(--shadow-soft);
      transition: all 0.4s ease;
      text-align: center;
      height: 100%;
      border: 1px solid rgba(0, 0, 0, 0.05);
      position: relative;
      overflow: hidden;
    }

    .service-card::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.8), transparent);
      transition: left 0.5s ease;
    }

    .service-card:hover::before {
      left: 100%;
    }

    .service-card:hover {
      transform: translateY(-15px);
      box-shadow: var(--shadow-hover);
    }

    .service-icon {
      width: 90px;
      height: 90px;
      margin: 0 auto 2rem;
      background: var(--gradient-primary);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 2.2rem;
      color: white;
      transition: transform 0.3s ease;
      position: relative;
      z-index: 1;
    }

    .service-card:hover .service-icon {
      transform: scale(1.1) rotate(5deg);
    }

    .service-card h4 {
      font-family: 'Poppins', sans-serif;
      font-weight: 600;
      margin-bottom: 1rem;
      color: var(--dark-color);
      font-size: 1.4rem;
      position: relative;
      z-index: 1;
    }

    .service-card p {
      color: #6b7280;
      line-height: 1.8;
      position: relative;
      z-index: 1;
    }

    .step-number {
      position: absolute;
      top: -15px;
      right: -15px;
      width: 50px;
      height: 50px;
      background: var(--gradient-secondary);
      color: white;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: 700;
      font-size: 1.2rem;
      box-shadow: 0 4px 15px rgba(37, 99, 235, 0.3);
    }

    .tutorial-section {
      background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
      padding: 4rem 0;
      margin: 4rem 0;
      border-radius: 20px;
    }

    .tutorial-btn {
      background: var(--gradient-secondary);
      border: none;
      color: white;
      padding: 1rem 3rem;
      border-radius: 50px;
      font-weight: 600;
      font-size: 1.1rem;
      box-shadow: 0 8px 25px rgba(37, 99, 235, 0.3);
      transition: all 0.3s ease;
      position: relative;
      overflow: hidden;
    }

    .tutorial-btn::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
      transition: left 0.5s ease;
    }

    .tutorial-btn:hover::before {
      left: 100%;
    }

    .tutorial-btn:hover {
      transform: translateY(-3px);
      box-shadow: 0 12px 30px rgba(37, 99, 235, 0.4);
    }

    .features-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 2rem;
      margin: 4rem 0;
    }

    .feature-item {
      background: white;
      padding: 2rem;
      border-radius: var(--border-radius);
      box-shadow: var(--shadow-soft);
      transition: all 0.3s ease;
      border-left: 4px solid var(--primary-color);
    }

    .feature-item:hover {
      transform: translateX(10px);
      box-shadow: var(--shadow-hover);
    }

    .feature-item i {
      font-size: 2rem;
      color: var(--primary-color);
      margin-bottom: 1rem;
    }

    .feature-item h5 {
      font-weight: 600;
      margin-bottom: 0.5rem;
      color: var(--dark-color);
    }

    .stats-section {
      background: var(--gradient-primary);
      color: white;
      padding: 4rem 0;
      margin: 4rem 0;
      border-radius: 20px;
    }

    .stat-item {
      text-align: center;
      padding: 2rem;
    }

    .stat-number {
      font-size: 3rem;
      font-weight: 800;
      margin-bottom: 0.5rem;
      display: block;
    }

    .stat-label {
      font-size: 1.1rem;
      opacity: 0.9;
    }

    .modal-content {
      border-radius: var(--border-radius);
      border: none;
      box-shadow: var(--shadow-hover);
    }

    .modal-header {
      background: var(--gradient-primary);
      color: white;
      border-radius: var(--border-radius) var(--border-radius) 0 0;
    }

    .btn-close {
      filter: brightness(0) invert(1);
    }

    .form-section {
      background: white;
      padding: 3rem;
      border-radius: var(--border-radius);
      box-shadow: var(--shadow-soft);
      margin: 4rem 0;
    }

    .form-control, .form-select {
      border-radius: 10px;
      border: 2px solid #e2e8f0;
      padding: 0.75rem 1rem;
      transition: all 0.3s ease;
    }

    .form-control:focus, .form-select:focus {
      border-color: var(--primary-color);
      box-shadow: 0 0 0 0.2rem rgba(255, 107, 53, 0.25);
    }

    .btn-submit {
      background: var(--gradient-accent);
      border: none;
      color: white;
      padding: 1rem 2rem;
      border-radius: 50px;
      font-weight: 600;
      transition: all 0.3s ease;
      box-shadow: 0 8px 25px rgba(16, 185, 129, 0.3);
    }

    .btn-submit:hover {
      transform: translateY(-3px);
      box-shadow: 0 12px 30px rgba(16, 185, 129, 0.4);
    }

    .btn-update {
      background: var(--gradient-primary);
      border: none;
      color: white;
      padding: 1rem 2rem;
      border-radius: 50px;
      font-weight: 600;
      transition: all 0.3s ease;
      box-shadow: 0 8px 25px rgba(255, 107, 53, 0.3);
    }

    .btn-update:hover {
      transform: translateY(-3px);
      box-shadow: 0 12px 30px rgba(255, 107, 53, 0.4);
    }

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

    .alert {
      border-radius: var(--border-radius);
      border: none;
      box-shadow: var(--shadow-soft);
    }

    .alert-success {
      background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
      color: #065f46;
    }

    .alert-danger {
      background: linear-gradient(135deg, #fef2f2 0%, #fecaca 100%);
      color: #991b1b;
    }

    @media (max-width: 768px) {
      .hero h1 {
        font-size: 2.5rem;
      }

      .hero p {
        font-size: 1.1rem;
      }

      .section-title h2 {
        font-size: 2rem;
      }

      .service-card {
        padding: 2rem 1.5rem;
      }

      .stat-number {
        font-size: 2.5rem;
      }
    }
  </style>
</head>
<body>
  <!-- Navigation -->
 @include('partials.header')

  <!-- Hero Section -->
  <section class="hero">
    <div class="container">
      <div class="hero-content">
        <h1><i class="bi bi-lightbulb me-3"></i>Comment ça marche ?</h1>
        <p>Découvrez comment YAAFO révolutionne la gestion des problèmes urbains<br>
        Une solution simple, efficace et collaborative pour tous</p>
        <div class="mt-4">
          <button class="btn tutorial-btn" data-bs-toggle="modal" data-bs-target="#videoModal">
            <i class="bi bi-play-circle me-2"></i>Voir la démonstration
          </button>
        </div>
      </div>
    </div>
  </section>

  <main class="container my-5">
    <!-- Section principale - Comment ça marche -->

    <!-- Section statistiques -->

    <!-- Section fonctionnalités -->
    <section class="section">
      <div class="section-title">
        <h2>Pourquoi choisir YAAFO ?</h2>
        <p>Une plateforme complète pour une ville plus connectée et réactive</p>
      </div>

      <div class="features-grid">
        <div class="feature-item">
          <i class="bi bi-geo-alt"></i>
          <h5>Géolocalisation précise</h5>
          <p>Localisation automatique des problèmes pour une intervention ciblée</p>
        </div>

        <div class="feature-item">
          <i class="bi bi-bell"></i>
          <h5>Notifications en temps réel</h5>
          <p>Restez informé des mises à jour et actions entreprises</p>
        </div>

        <div class="feature-item">
          <i class="bi bi-camera"></i>
          <h5>Preuves photographiques</h5>
          <p>Ajoutez des photos pour documenter efficacement les problèmes</p>
        </div>

        <div class="feature-item">
          <i class="bi bi-graph-up"></i>
          <h5>Suivi des progrès</h5>
          <p>Visualisez l'évolution et l'impact de vos signalements</p>
        </div>

        <div class="feature-item">
          <i class="bi bi-shield-check"></i>
          <h5>Sécurité garantie</h5>
          <p>Vos données sont protégées et votre anonymat respecté</p>
        </div>

        <div class="feature-item">
          <i class="bi bi-chat-dots"></i>
          <h5>Communication directe</h5>
          <p>Échangez directement avec les autorités compétentes</p>
        </div>
      </div>
    </section>

    <!-- Section tutoriel -->
    <section class="tutorial-section text-center">
      <div class="container">
        <h3 class="mb-4">Besoin d'aide pour commencer ?</h3>
        <p class="mb-4">Regardez notre tutoriel détaillé pour maîtriser toutes les fonctionnalités</p>
        <button type="button" class="btn tutorial-btn" data-bs-toggle="modal" data-bs-target="#videoModal">
          <i class="bi bi-play-circle me-2"></i>Voir le tutoriel complet
        </button>
      </div>
    </section>

    <!-- Modal tutoriel -->
    <div class="modal fade" id="videoModal" tabindex="-1">
      <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title"><i class="bi bi-play-circle me-2"></i>Tutoriel YAAFO</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <div class="ratio ratio-16x9">
              <iframe src="https://www.youtube.com/embed/dQw4w9WgXcQ" allowfullscreen></iframe>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Formulaire création/modification -->
 <section>
  {{-- MESSAGES DE SUCCÈS --}}
  @if(session('success'))
    <div class="alert alert-success">
      <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
    </div>
  @endif

  {{-- MESSAGES D'ERREUR GÉNÉRAUX --}}
  @if($errors->any())
    <div class="alert alert-danger">
      <i class="bi bi-exclamation-triangle me-2"></i>Veuillez corriger les erreurs ci-dessous.
    </div>
  @endif

  <!-- FORMULAIRE -->
  <section class="form-section" id="signaler-probleme">
    <div class="text-center mb-4">
      <h2>{{ isset($alerte) ? 'Modifier l’alerte' : 'Créer une alerte' }}</h2>
      <p class="text-muted">{{ isset($alerte) ? 'Mettez à jour les détails du problème' : 'Signalez un problème dans votre quartier' }}</p>
    </div>

    <form action="{{ isset($alerte) ? route('alertes.update', $alerte->id) : route('alertes.store') }}" method="POST" enctype="multipart/form-data" id="alertForm">
      @csrf
      @if(isset($alerte))
        @method('PUT')
      @endif

      <div class="row">
        <div class="col-md-6">
          <div class="mb-3">
            <label for="title" class="form-label">Titre du problème *</label>
            <input type="text" name="title" id="title" value="{{ old('title', $alerte->title ?? '') }}"
              class="form-control @error('title') is-invalid @enderror" required>
            @error('title')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
        </div>
        <div class="col-md-6">
          <div class="mb-3">
            <label for="category" class="form-label">Catégorie *</label>
            <select name="category_id" id="category" class="form-select @error('category_id') is-invalid @enderror" required>
              <option value="">Choisir une catégorie</option>
               @foreach($categories as $cat)
                <option value="{{ $cat->id }}" >
               {{ $cat->name }}
              </option>
                 @endforeach
            </select>
            @error('category_id')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
        </div>
      </div>

      <div class="mb-3">
        <label for="description" class="form-label">Description détaillée *</label>
        <textarea name="description" id="description" rows="4"
          class="form-control @error('description') is-invalid @enderror"
          required>{{ old('description', $alerte->description ?? '') }}</textarea>
        @error('description')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="row">
        <div class="col-md-6">
          <div class="mb-3">
            <label for="quartier" class="form-label">Quartier *</label>
            <select name="quartier" id="quartier" class="form-select @error('quartier') is-invalid @enderror" required>
              <option value="">Choisir un quartier</option>
              @php
                $quartiers = ['medina', 'grand-yoff', 'parcelles', 'plateau', 'hann'];
              @endphp
              @foreach($quartiers as $q)
                <option value="{{ $q }}" {{ old('quartier', $alerte->quartier ?? '') == $q ? 'selected' : '' }}>
                  {{ ucfirst(str_replace('-', ' ', $q)) }}
                </option>
              @endforeach
            </select>
            @error('quartier')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
        </div>
        <div class="col-md-6">
          <div class="mb-3">
            <label for="images" class="form-label">Photos</label>
            <input type="file" name="images[]" id="images" multiple accept="image/*"
              class="form-control @error('images.*') is-invalid @enderror">
            @error('images.*')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <small class="form-text text-muted">Ajoutez jusqu'à 3 photos pour documenter le problème</small>
          </div>
        </div>
      </div>

      <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="geolocation" checked>
        <label for="geolocation" class="form-check-label">
          <i class="bi bi-geo-alt me-1"></i>Utiliser ma position actuelle
        </label>
      </div>

      <input type="hidden" name="latitude" id="latitude" value="{{ old('latitude', $alerte->latitude ?? '') }}">
      <input type="hidden" name="longitude" id="longitude" value="{{ old('longitude', $alerte->longitude ?? '') }}">

      <div class="text-center">
        <button type="submit" class="btn {{ isset($alerte) ? 'btn-update' : 'btn-submit' }}">
          <i class="bi bi-send me-2"></i>{{ isset($alerte) ? 'Mettre à jour' : 'Envoyer l’alerte' }}
        </button>
      </div>
    </form>
  </section>

  <!-- Liste des alertes de l'utilisateur -->
   <div class="text-center"><a href="/cartesdesalertes" class="btn btn-primary"><i class="bi bi-eye me-2"></i>voir mes alertes</a></div>

  </main>

  <!-- Footer -->
 @include('partials.footer')

  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
 <script>
  // Géolocalisation automatique
  const geoCheckbox = document.getElementById('geolocation');
  const latInput = document.getElementById('latitude');
  const lngInput = document.getElementById('longitude');

  function getLocation() {
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(
        (position) => {
          latInput.value = position.coords.latitude;
          lngInput.value = position.coords.longitude;
          console.log('Latitude:', latInput.value, 'Longitude:', lngInput.value);
        },
        (error) => {
          console.warn("Géolocalisation refusée ou échouée.", error);
          latInput.value = '';
          lngInput.value = '';
        }
      );
    } else {
      alert("La géolocalisation n'est pas supportée par votre navigateur.");
    }
  }

  // Lorsqu'on coche ou décoche l'option
  geoCheckbox.addEventListener('change', function () {
    if (this.checked) {
      getLocation();
    } else {
      latInput.value = '';
      lngInput.value = '';
    }
  });

  // Appel automatique au chargement si activé
  document.addEventListener('DOMContentLoaded', function () {
    if (geoCheckbox.checked) {
      getLocation();
    }
  });
</script>
