<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Carte des Alertes - YAAFO</title>
  <link rel="icon" href="img/favicon.png">
  <link rel="apple-touch-icon" href="img/apple-touch-icon.png">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

  <!-- Bootstrap 5 -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" rel="stylesheet">

  <!-- Leaflet CSS -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />
  <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.css" />
  <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.Default.css" />
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <style>
      :root {
  --primary-color:   #363753;  /* Bleu foncé / violet foncé (boutons, header) */
  --secondary-color: #5CD2C6;  /* Turquoise clair (hover, accents) */
  --accent-color:    #5CD2C6;  /* Turquoise clair (badges, effets) */
  --warning-color:   #DC2626;  /* Rouge alerte */
  --dark-color:      #363753;  /* Texte sombre / fond sombre */
  --light-color:     #FEFEFE;  /* Blanc très clair */
  --muted-color:     #DFE3EE;  /* Gris clair / fond doux */

  --border-radius: 12px;
  --shadow-soft: 0 4px 16px rgba(54, 55, 83, 0.05);
  --shadow-hover: 0 8px 24px rgba(54, 55, 83, 0.1);

  --gradient-primary: linear-gradient(135deg, #363753 0%, #5CD2C6 100%);
  --gradient-dark: linear-gradient(135deg, #2b2e4a 0%, #1f2233 100%);
  --text-muted: #a0aec0; /* Gris clair plus visible */
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

    .hero {
      background: var(--gradient-primary);
      color: white;
      padding: 100px 0 60px;
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
      font-size: 3rem;
      font-weight: 700;
      margin-bottom: 1rem;
      text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
    }

    .hero p {
      font-size: 1.2rem;
      opacity: 0.9;
    }

    .filters-section {
      background: white;
      padding: 2rem 0;
      box-shadow: var(--shadow-soft);

      top: 76px;
      z-index: 1000;
    }

    .filter-card {
      background: white;
      border-radius: var(--border-radius);
      padding: 2rem;
      box-shadow: var(--shadow-soft);
      border: 1px solid rgba(0, 0, 0, 0.05);
    }

    .form-select, .form-control {
      border-radius: 10px;
      border: 2px solid #e2e8f0;
      padding: 0.75rem 1rem;
      transition: all 0.3s ease;
    }

    .form-select:focus, .form-control:focus {
      border-color: var(--primary-color);
      box-shadow: 0 0 0 0.2rem rgba(255, 107, 53, 0.25);
    }

    .btn-filter {
      background: var(--gradient-primary);
      border: none;
      color: white;
      padding: 0.75rem 2rem;
      border-radius: 50px;
      font-weight: 600;
      transition: all 0.3s ease;
      box-shadow: 0 4px 15px rgba(255, 107, 53, 0.3);
    }

    .btn-filter:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 25px rgba(255, 107, 53, 0.4);
    }

    .btn-reset {
      background: transparent;
      border: 2px solid #6b7280;
      color: #6b7280;
      padding: 0.75rem 2rem;
      border-radius: 50px;
      font-weight: 600;
      transition: all 0.3s ease;
    }

    .btn-reset:hover {
      background: #6b7280;
      color: white;
    }

    .stats-bar {
      background: var(--gradient-secondary);
      color: white;
      padding: 1rem 0;
      margin-bottom: 2rem;
      border-radius: var(--border-radius);
    }

    .stat-item {
      text-align: center;
      padding: 0.5rem;
    }

    .stat-number {
      font-size: 1.5rem;
      font-weight: 700;
      display: block;
    }

    .stat-label {
      font-size: 0.9rem;
      opacity: 0.9;
    }

    #map {
      height: 600px;
      border-radius: var(--border-radius);
      box-shadow: var(--shadow-soft);
      border: 1px solid rgba(0, 0, 0, 0.05);
    }

    .map-controls {
      position: absolute;
      top: 10px;
      right: 10px;
      z-index: 1000;
      display: flex;
      flex-direction: column;
      gap: 0.5rem;
    }

    .map-control-btn {
      background: white;
      border: none;
      border-radius: 8px;
      padding: 0.5rem;
      box-shadow: var(--shadow-soft);
      color: var(--dark-color);
      transition: all 0.3s ease;
    }

    .map-control-btn:hover {
      background: var(--primary-color);
      color: white;
      transform: scale(1.05);
    }

    .alert-card {
      background: white;
      border-radius: var(--border-radius);
      padding: 1.5rem;
      margin-bottom: 1.5rem;
      box-shadow: var(--shadow-soft);
      border: 1px solid rgba(0, 0, 0, 0.05);
      transition: all 0.3s ease;
      position: relative;
    }

    .alert-card:hover {
      transform: translateY(-3px);
      box-shadow: var(--shadow-hover);
    }

    .alert-image {
      width: 100px;
      height: 100px;
      object-fit: cover;
      border-radius: 8px;
      margin-right: 1rem;
    }

    .alert-category {
      display: inline-block;
      padding: 0.25rem 0.75rem;
      border-radius: 20px;
      font-size: 0.8rem;
      font-weight: 600;
      margin-bottom: 0.5rem;
    }

    .category-voirie { background: #dbeafe; color: #1e40af; }
    .category-environnement { background: #d1fae5; color: #065f46; }
    .category-securite { background: #fee2e2; color: #991b1b; }
    .category-default { background: #f3f4f6; color: #374151; }

    .alert-status {
      position: absolute;
      top: 1rem;
      right: 1rem;
      padding: 0.25rem 0.75rem;
      border-radius: 20px;
      font-size: 0.8rem;
      font-weight: 600;
    }

    .status-en-cours { background: #fef3c7; color: #92400e; }
    .status-resolu { background: #d1fae5; color: #065f46; }
    .status-nouveau { background: #fee2e2; color: #991b1b; }

    .alert-actions {
      display: flex;
      gap: 0.5rem;
      margin-top: 1rem;
    }

    .btn-action {
      padding: 0.5rem 1rem;
      border-radius: 25px;
      border: none;
      font-weight: 500;
      transition: all 0.3s ease;
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
    }

    .btn-edit {
      background: var(--gradient-accent);
      color: white;
    }

    .btn-edit:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
    }

    .btn-delete {
      background: var(--gradient-primary);
      color: white;
    }

    .btn-delete:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 15px rgba(255, 107, 53, 0.3);
    }

    .btn-view {
      background: var(--gradient-secondary);
      color: white;
    }

    .btn-view:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 15px rgba(37, 99, 235, 0.3);
    }

    .custom-popup {
      max-width: 300px;
    }

    .custom-popup .popup-header {
      background: var(--gradient-primary);
      color: white;
      padding: 1rem;
      margin: -1rem -1rem 1rem -1rem;
      border-radius: 8px 8px 0 0;
    }

    .custom-popup .popup-image {
      width: 100%;
      height: 150px;
      object-fit: cover;
      border-radius: 8px;
      margin-bottom: 1rem;
    }

    .custom-popup .popup-category {
      display: inline-block;
      padding: 0.25rem 0.75rem;
      border-radius: 20px;
      font-size: 0.8rem;
      font-weight: 600;
      margin-bottom: 0.5rem;
    }

    .loading-spinner {
      display: none;
      text-align: center;
      padding: 2rem;
    }

    .spinner-border {
      color: var(--primary-color);
    }

    .no-results {
      text-align: center;
      padding: 4rem 2rem;
      color: #6b7280;
    }

    .no-results i {
      font-size: 4rem;
      margin-bottom: 1rem;
      color: #d1d5db;
    }

    .legend {
      position: absolute;
      bottom: 10px;
      left: 10px;
      z-index: 1000;
      background: white;
      padding: 1rem;
      border-radius: 8px;
      box-shadow: var(--shadow-soft);
      font-size: 0.9rem;
    }

    .legend-item {
      display: flex;
      align-items: center;
      margin-bottom: 0.5rem;
    }

    .legend-color {
      width: 20px;
      height: 20px;
      border-radius: 50%;
      margin-right: 0.5rem;
    }

    .toggle-view {
      position: fixed;
      bottom: 20px;
      right: 20px;
      z-index: 1000;
      background: var(--gradient-primary);
      color: white;
      border: none;
      border-radius: 50px;
      padding: 1rem 1.5rem;
      font-weight: 600;
      box-shadow: 0 4px 20px rgba(255, 107, 53, 0.3);
      transition: all 0.3s ease;
    }

    .toggle-view:hover {
      transform: translateY(-3px);
      box-shadow: 0 8px 25px rgba(255, 107, 53, 0.4);
    }

    @media (max-width: 768px) {
      .hero h1 {
        font-size: 2.5rem;
      }

      .filter-card {
        padding: 1rem;
      }

      #map {
        height: 400px;
      }

      .alert-card {
        padding: 1rem;
      }

      .alert-image {
        width: 80px;
        height: 80px;
      }

      .toggle-view {
        bottom: 10px;
        right: 10px;
        padding: 0.75rem 1rem;
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
        <h1><i class="bi bi-geo-alt me-3"></i>Carte des Alertes</h1>
        <p>Visualisez en temps réel tous les signalements de votre région</p>
      </div>
    </div>
  </section>

  <main class="main">
    <!-- Statistiques -->
    <section class="container mt-4">
  <div class="stats-bar">
    <div class="container">
      <div class="row">
        <div class="col-md-3">
          <div class="stat-item">
            <span class="stat-number">{{ $statistiques['total'] }}</span>
            <span class="stat-label">Total des alertes</span>
          </div>
        </div>
        <div class="col-md-3">
          <div class="stat-item">
            <span class="stat-number">{{ $statistiques['actives'] }}</span>
            <span class="stat-label">Alertes actives</span>
          </div>
        </div>
        <div class="col-md-3">
          <div class="stat-item">
            <span class="stat-number">{{ $statistiques['resolues'] }}</span>
            <span class="stat-label">Alertes résolues</span>
          </div>
        </div>
        <div class="col-md-3">
          <div class="stat-item">
            <span class="stat-number">{{ $statistiques['mois'] }}</span>
            <span class="stat-label">Ce mois-ci</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="container py-5">
  <h2 class="mb-4 fw-bold">📢 Toutes les alertes</h2>

  <div class="row g-4">
    @foreach ($alertes as $alerte)
      <div class="col-md-4">
        <div class="card shadow-sm h-100">
 @if($alerte->images->count())
  <div class="info-card">
    <div class="image-gallery">
      <div class="image-item">
        <img src="{{ asset('storage/' . $alerte->images->first()->path) }}" alt="Image de l'alerte" width="100%">
      </div>
    </div>
  </div>
@endif
       <div class="card-body">
            <h5 class="card-title">{{ $alerte->title }}</h5>
            <span class="badge

            ">
             {{ optional($alerte->category)->nom ?? 'Non catégorisé' }}

            </span>

            <p class="card-text mt-2 text-truncate">{{ Str::limit($alerte->description, 100) }}</p>
            <p class="text-muted small">
              <i class="bi bi-person"></i> {{ $alerte->user->name ?? 'Anonyme' }}
              • <i class="bi bi-geo-alt"></i> {{ $alerte->quartier ?? 'Inconnu' }}
            </p>

            <a href="{{ route('alertes.show', $alerte->id) }}" class="btn btn-outline-success mt-auto ">
              <i class="bi bi-eye"></i> Voir plus
            </a>
<form action="{{ route('commentaire.store') }}" method="POST" class="mt-3">
  @csrf
  <input type="hidden" name="alerte_id" value="{{ $alerte->id }}">
  <div class="input-group">
    <input type="text" name="contenu" class="form-control form-control-sm" placeholder="Ajouter un commentaire..." required>
    <button class="btn btn-sm btn-primary" type="submit">Envoyer</button>
  </div>
</form>

          </div>
        </div>
      </div>
    @endforeach
  </div>

  <!-- Pagination si nécessaire -->
<div class="mt-4 d-flex justify-content-center">
    {{ $alertes->links() }}
</div>

</section>
<section class="container py-5">

  <section class="my-5">
  <h2 class="text-success fw-bold mb-4">📢 Projets communautaires</h2>

  @if($projets->isEmpty())
    <p class="text-muted">Aucun projet soumis pour le moment.</p>
  @else
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
      @foreach($projets as $projet)
        <div class="col">
          <div class="card h-100 shadow-sm border-0">
            @if($projet->image)
              <img src="{{ asset('storage/' . $projet->image) }}" class="card-img-top" alt="{{ $projet->titre }}" style="max-height: 180px; object-fit: cover;">
            @endif
            <div class="card-body d-flex flex-column">
              <h5 class="card-title text-success">{{ $projet->titre }}</h5>
              <p class="text-muted mb-1"><strong>Quartier :</strong> {{ $projet->quartier ?? 'Non précisé' }}</p>
              <p class="mb-2">{{ Str::limit($projet->description, 100) }}</p>
              <p class="fw-bold text-dark">🎯 Objectif : {{ number_format($projet->objectif, 0, ',', ' ') }} FCFA</p>
               <div class="progress mb-2" style="height: 8px;">
              <div class="progress-bar" style="width: {{ $projet->pourcentage }}%"></div>
            </div>
            <small>{{ number_format($projet->montant_actuel, 0, ',', ' ') }} FCFA sur {{ number_format($projet->objectif, 0, ',', ' ') }} FCFA</small>
              <a href="{{ route('projets.show', $projet->id) }}" class="btn btn-outline-success mt-auto">Voir le projet</a>
            </div>
          </div>
        </div>
      @endforeach
    </div>


  @endif
</section>
</section>

    <!-- Filtres -->
    <section class="filters-section">
      <div class="container">
        <div class="filter-card">
          <div class="row g-3 align-items-end">
            <div class="col-md-3">
              <label for="categorie" class="form-label fw-bold">
                <i class="bi bi-funnel me-2"></i>Catégorie
              </label>
              <select id="categorie" class="form-select">
                <option value="all">Toutes les catégories</option>
                @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                    {{ $category->nom }}
                </option>
                 @endforeach
              </select>
            </div>
            <div class="col-md-3">
              <label for="quartier" class="form-label fw-bold">
                <i class="bi bi-house me-2"></i>Quartier
              </label>
              <select id="quartier" class="form-select">
                <option value="all">Tous les quartiers</option>
                <option value="medina">Medina</option>
                <option value="grand-yoff">Grand-Yoff</option>
                <option value="parcelles">Parcelles</option>
                <option value="plateau">Plateau</option>
                <option value="hann">Hann</option>
              </select>
            </div>
            <div class="col-md-3">
              <label for="statut" class="form-label fw-bold">
                <i class="bi bi-flag me-2"></i>Statut
              </label>
              <select id="statut" class="form-select">
                <option value="all">Tous les statuts</option>
               <option value="ouverte" {{ request('status') == 'ouverte' ? 'selected' : '' }}>Ouverte</option>
            <option value="en_cours" {{ request('status') == 'en_cours' ? 'selected' : '' }}>En cours</option>
            <option value="résolue" {{ request('status') == 'résolue' ? 'selected' : '' }}>Résolue</option>
              </select>
            </div>
            <div class="col-md-3">
              <div class="d-flex gap-2">
                <button id="filtrer" class="btn btn-filter flex-fill">
                  <i class="bi bi-search me-2"></i>Filtrer
                </button>
                <button id="reset" class="btn btn-reset">
                  <i class="bi bi-arrow-clockwise"></i>
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Carte et Liste -->
    <section class="py-4">
      <div class="container">
        <div class="row">
          <!-- Carte -->
          <div class="col-lg-8 mb-4">
            <div class="position-relative">
              <div id="map"></div>

              <!-- Contrôles de la carte -->
              <div class="map-controls">
                <button class="map-control-btn" id="fullscreen" title="Plein écran">
                  <i class="bi bi-arrows-fullscreen"></i>
                </button>
                <button class="map-control-btn" id="locate" title="Ma position">
                  <i class="bi bi-geo-alt"></i>
                </button>
                <button class="map-control-btn" id="cluster-toggle" title="Grouper les marqueurs">
                  <i class="bi bi-collection"></i>
                </button>
              </div>

              <!-- Légende -->
              <div class="legend">
                <h6 class="mb-2">Légende</h6>
                <div class="legend-item">
                  <div class="legend-color" style="background: #ef4444;"></div>
                  <span>Nouveau</span>
                </div>
                <div class="legend-item">
                  <div class="legend-color" style="background: #f59e0b;"></div>
                  <span>En cours</span>
                </div>
                <div class="legend-item">
                  <div class="legend-color" style="background: #10b981;"></div>
                  <span>Résolu</span>
                </div>
              </div>
            </div>
          </div>

          <!-- Liste des alertes -->
          <div class="col-lg-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
              <h4>Alertes récentes</h4>
              <span class="badge bg-primary" id="count-alertes">0</span>
            </div>

            <!-- Spinner de chargement -->
            <div class="loading-spinner" id="loading">
              <div class="spinner-border" role="status">
                <span class="visually-hidden">Chargement...</span>
              </div>
              <p class="mt-2">Chargement des alertes...</p>
            </div>

            <!-- Liste des alertes -->
            <div id="alertes-list" style="max-height: 600px; overflow-y: auto;">
              <!-- Les alertes seront affichées ici -->
            </div>

            <!-- Message si aucun résultat -->
            <div class="no-results d-none" id="no-results">
              <i class="bi bi-search"></i>
              <h5>Aucune alerte trouvée</h5>
              <p>Essayez de modifier vos critères de recherche</p>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

  <!-- Bouton pour basculer entre carte et liste -->

 <div style="position: fixed; bottom: 20px; right: 20px; z-index: 10000;">
  <button class="toggle-view" id="toggle-view">
    <i class="bi bi-list me-2"></i>Voir la liste
  </button>
</div>


  <!-- Footer -->
  @include('partials.footer')

  <!-- Scripts -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
  <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>
  <script src="https://unpkg.com/leaflet.markercluster@1.5.3/dist/leaflet.markercluster.js"></script>
<script>
 const alertesData = {!! json_encode($alertesJs ?? []) !!};

console.log("DEBUG alertesData :", alertesData);
if (!Array.isArray(alertesData)) {
  console.error("alertesData is not a valid array");
}

let map;
let markers = L.markerClusterGroup();
let currentMarkers = [];

const alertesList = document.getElementById("alertes-list");
const loading = document.getElementById("loading");
const noResults = document.getElementById("no-results");

const getMarkerColor = (status) => {
  switch (status) {
    case 'nouveau': return '#ef4444';
    case 'en_cours': return '#f59e0b';
    case 'résolue': return '#10b981';
    default: return '#6b7280';
  }
};

function initMap() {
  map = L.map('map').setView([14.6928, -17.4467], 12);
  L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
    maxZoom: 19,
    attribution: '© Esri | Sources: Esri, Maxar, Earthstar Geographics, and the GIS User Community'
  }).addTo(map);

  map.addLayer(markers);
  displayAlertes(alertesData);
}

function displayAlertes(data) {
  markers.clearLayers();
  currentMarkers = [];
  alertesList.innerHTML = '';
  loading.style.display = 'none';
  noResults.classList.add("d-none");

  if (data.length === 0) {
    noResults.classList.remove("d-none");
    return;
  }

  let countActives = 0, countResolved = 0, countThisMonth = 0;
  const now = new Date();

  data.forEach(alerte => {
    const marker = L.circleMarker([alerte.latitude, alerte.longitude], {
      color: getMarkerColor(alerte.statut),
      radius: 10,
      fillOpacity: 0.9
    });

    const popup = `
      <div class="custom-popup">
        <div class="popup-header">${alerte.title}</div>
        <img src="${alerte.images.length > 0 ? alerte.images[0].path : '/img/default.jpg'}" alt="Image de l'alerte" class="popup-image">
        <div class="popup-category category-${alerte.category.name}">${alerte.category.name}</div>
        <p>${alerte.description}</p>
        <small><i class="bi bi-person"></i> ${alerte.auteur}</small>
        <hr />
        <h6 class="mt-2">Commentaires :</h6>
        <div style="max-height:100px; overflow-y:auto;">
          ${alerte.commentaires.map(c => `
            <div style="font-size: 0.85rem; margin-bottom: 0.5rem;">
              <strong>${c.auteur}</strong> (${c.date})<br />${c.contenu}
            </div>
          `).join('') || '<em>Aucun commentaire.</em>'}
        </div>
      </div>`;

    marker.bindPopup(popup);
    markers.addLayer(marker);
    currentMarkers.push(marker);

    const html = `
      <div class="custom-popup" id="alerte-${alerte.id}">
        <div class="popup-header">${alerte.title}</div>
        <img src="${alerte.images.length > 0 ? alerte.images[0].path : '/img/default.jpg'}" alt="Image de l'alerte" class="popup-image">
        <div class="popup-category category-${alerte.category.name}">${alerte.category.name}</div>
        <p>${alerte.description}</p>
        <small><i class="bi bi-person"></i> ${alerte.auteur}</small>
        <div class="popup-comments mt-3" id="commentaires-${alerte.id}" style="font-size: 0.85rem;">
          ${alerte.commentaires?.map(c => `
            <div style="margin-bottom: 0.5rem;">
              <strong>${c.user?.name || 'Anonyme'}</strong><br />${c.contenu}
            </div>
          `).join('')}
        </div>
        <hr />
        <h6 class="mt-3">Ajouter un commentaire :</h6>
        <form onsubmit="return envoyerCommentaire(event, ${alerte.id})">
          <textarea class="form-control mb-2" rows="2" placeholder="Votre commentaire..." name="contenu"></textarea>
          <button class="btn btn-sm btn-primary w-100" type="submit">
            <i class="bi bi-send me-1"></i>Envoyer
          </button>
        </form>
      </div>`;

    alertesList.insertAdjacentHTML("beforeend", html);

    if (alerte.statut === "en_cours") countActives++;
    if (alerte.statut === "résolue") countResolved++;
    if (new Date(alerte.created_at).getMonth() === now.getMonth()) countThisMonth++;
  });

  // Si tu veux mettre à jour ces stats dans la page, assure-toi d'avoir ces éléments en HTML
  if(document.getElementById("total-alertes")) document.getElementById("total-alertes").innerText = data.length;
  if(document.getElementById("alertes-actives")) document.getElementById("alertes-actives").innerText = countActives;
  if(document.getElementById("alertes-resolues")) document.getElementById("alertes-resolues").innerText = countResolved;
  if(document.getElementById("alertes-mois")) document.getElementById("alertes-mois").innerText = countThisMonth;

  document.getElementById("count-alertes").innerText = data.length;
}

async function envoyerCommentaire(event, alertId) {
  event.preventDefault();
  const form = event.target;
  const contenu = form.contenu.value.trim();
  if (!contenu) return;

  try {
    const response = await fetch("/commentaires", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
      },
      body: JSON.stringify({ alert_id: alertId, contenu })
    });

    const data = await response.json();
    const commentaireHtml = `
      <div style="font-size: 0.85rem; margin-bottom: 0.5rem;">
        <strong>${data.auteur}</strong> (${data.date})<br />${data.contenu}
      </div>`;

    const listeContainer = document.getElementById(`commentaires-${alertId}`);
    if (listeContainer) listeContainer.insertAdjacentHTML("beforeend", commentaireHtml);

    form.reset();
  } catch (error) {
    alert("Erreur lors de l'envoi du commentaire.");
  }
}

document.getElementById("filtrer").addEventListener("click", () => {
  const cat = document.getElementById("categorie").value;
  const q = document.getElementById("quartier").value;
  const statut = document.getElementById("statut").value;

  const filtered = alertesData.filter(a =>
    (cat === 'all' || a.category.id == cat) &&
    (q === 'all' || a.quartier === q) &&
    (statut === 'all' || a.statut === statut)
  );

  displayAlertes(filtered);
});

document.getElementById("reset").addEventListener("click", () => {
  document.getElementById("categorie").value = 'all';
  document.getElementById("quartier").value = 'all';
  document.getElementById("statut").value = 'all';
  displayAlertes(alertesData);
});

document.getElementById("toggle-view").addEventListener("click", () => {
  const mapContainer = document.querySelector("#map").parentElement;
  const listContainer = document.querySelector("#alertes-list").parentElement;
  const isMapVisible = mapContainer.style.display !== 'none' && mapContainer.style.display !== '';

  mapContainer.style.display = isMapVisible ? 'none' : 'block';
  listContainer.style.display = isMapVisible ? 'block' : 'none';
  document.getElementById("toggle-view").innerHTML = isMapVisible
    ? '<i class="bi bi-geo-alt me-2"></i>Voir la carte'
    : '<i class="bi bi-list me-2"></i>Voir la liste';
});

document.getElementById("locate").addEventListener("click", () => {
  if (!navigator.geolocation) return alert("Géolocalisation non supportée");
  navigator.geolocation.getCurrentPosition(pos => {
    const { latitude, longitude } = pos.coords;
    map.setView([latitude, longitude], 15);
    L.circle([latitude, longitude], { radius: 30, color: "#2563eb" }).addTo(map);
  });
});

document.addEventListener("DOMContentLoaded", () => {
  loading.style.display = "block";
  initMap();
});

</script>
