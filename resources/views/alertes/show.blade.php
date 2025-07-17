
<!-- METS CE FICHIER DANS resources/views/alertes/show.blade.php -->

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Détails de l'Alerte - Yaafo</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">


   <style>
    :root {
  /* Couleurs principales */
  --primary-color: #7c3aed;          /* Violet moderne */
  --secondary-color: #06b6d4;        /* Cyan vibrant */

  /* Accent et nuances */
  --accent-color: #10b981;           /* Emerald */
  --warning-color: #f39c12;          /* Amber */
  --danger-color: #e74c3c;           /* Rouge corail */

  /* Textes & fonds */
  --dark-text: #0f172a;              /* Slate foncé (texte principal) */
  --light-bg: #f8fafc;               /* Fond très clair */

  /* Neutres */
  --neutral-color: #64748b;          /* Slate moyen */

  /* Bordures & ombres */
  --border-radius: 16px;
  --shadow-soft: 0 4px 6px -1px rgba(0, 0, 0, 0.1),
                 0 2px 4px -2px rgba(0, 0, 0, 0.1);
  --shadow-hover: 0 20px 25px -5px rgba(0, 0, 0, 0.1),
                 0 8px 10px -6px rgba(0, 0, 0, 0.1);

  /* Dégradés */
  --gradient-primary: linear-gradient(135deg, #7c3aed 0%, #06b6d4 100%);
  --gradient-secondary: linear-gradient(135deg, #10b981 0%, #059669 100%);
  --gradient-hero: linear-gradient(135deg, #2b2e4a 0%, #1f2233 100%);
}

/* Reset et base */
body {
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  background: var(--gradient-hero);
  color: var(--dark-text);
  margin: 0;
  min-height: 100vh;
}

/* Container principal */
.main-container {
  background: rgba(248, 250, 252, 0.95); /* var(--light-bg) */
  backdrop-filter: blur(10px);
  border-radius: var(--border-radius);
  box-shadow: var(--shadow-soft);
  margin: 2rem auto;
  max-width: 1200px;
  overflow: hidden;
  animation: slideUp 0.6s ease-out;
  padding: 0;
}

/* Animation slide up */
@keyframes slideUp {
  from {
    opacity: 0;
    transform: translateY(30px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

/* Section header */
.header-section {
  background: var(--gradient-primary);
  color: white;
  padding: 2rem;
  position: relative;
  overflow: hidden;
}

.header-section::before {
  content: '';
  position: absolute;
  inset: 0;
  background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse"><path d="M 10 0 L 0 0 0 10" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="1"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>') no-repeat center center;
  opacity: 0.3;
  pointer-events: none;
  z-index: 0;
}

.header-content {
  position: relative;
  z-index: 1;
}

/* Bouton retour */
.back-btn {
  background: rgba(255 255 255 / 0.2);
  border: 2px solid rgba(255 255 255 / 0.3);
  color: white;
  padding: 0.75rem 1.5rem;
  border-radius: 50px;
  text-decoration: none;
  display: inline-flex;
  align-items: center;
  gap: 0.5rem;
  transition: all 0.3s ease;
  backdrop-filter: blur(10px);
  margin-bottom: 1.5rem;
  font-weight: 600;
  font-size: 1rem;
}

.back-btn:hover {
  background: rgba(255 255 255 / 0.3);
  transform: translateX(-5px);
  color: white;
}

/* Titre de l'alerte */
.alert-title {
  font-size: 2.5rem;
  font-weight: 700;
  margin-bottom: 1rem;
  text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
}

/* Badges de statut */
.status-badge {
  padding: 0.5rem 1rem;
  border-radius: 50px;
  font-weight: 600;
  font-size: 0.9rem;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  animation: pulse 2s infinite;
  display: inline-block;
}

@keyframes pulse {
  0%, 100% { transform: scale(1); }
  50% { transform: scale(1.05); }
}

.status-en-cours { background: var(--warning-color); color: var(--dark-text); }
.status-resolu { background: var(--accent-color); color: white; }
.status-nouveau { background: var(--primary-color); color: white; }
.status-urgent { background: var(--danger-color); color: white; }

/* Section contenu */
.content-section {
  padding: 2rem;
}

/* Cartes info */
.info-card {
  background: var(--light-bg);
  border-radius: var(--border-radius);
  padding: 1.5rem;
  margin-bottom: 1.5rem;
  box-shadow: var(--shadow-soft);
  border-left: 4px solid var(--primary-color);
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.info-card:hover {
  transform: translateY(-2px);
  box-shadow: var(--shadow-hover);
}

/* Item info */
.info-item {
  display: flex;
  align-items: center;
  margin-bottom: 1rem;
  padding: 0.75rem;
  background: #f1f5f9; /* un gris très clair */
  border-radius: 8px;
  transition: background 0.3s ease;
}

.info-item:hover {
  background: #e2e8f0; /* gris un peu plus foncé */
}

/* Icones */
.info-icon {
  width: 40px;
  height: 40px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  margin-right: 1rem;
  color: white;
  font-size: 1.1rem;
}

.icon-category { background: var(--secondary-color); }
.icon-location { background: var(--danger-color); }
.icon-author { background: var(--accent-color); }
.icon-description { background: var(--warning-color); }

/* Galerie images */
.image-gallery {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
  gap: 1rem;
  margin: 2rem 0;
}

.image-item {
  position: relative;
  border-radius: var(--border-radius);
  overflow: hidden;
  box-shadow: var(--shadow-soft);
  transition: transform 0.3s ease;
  cursor: pointer;
}

.image-item:hover {
  transform: scale(1.05);
}

.image-item img {
  width: 100%;
  height: 250px;
  object-fit: cover;
  transition: transform 0.3s ease;
}

.image-item:hover img {
  transform: scale(1.1);
}

/* Section commentaires */
.comments-section {
  margin-top: 3rem;
}

.comments-header {
  display: flex;
  align-items: center;
  gap: 1rem;
  margin-bottom: 2rem;
  padding-bottom: 1rem;
  border-bottom: 2px solid #e2e8f0;
}

.comment-item {
  background: var(--light-bg);
  border-radius: var(--border-radius);
  padding: 1.5rem;
  margin-bottom: 1rem;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
  border-left: 3px solid var(--secondary-color);
  animation: fadeIn 0.5s ease-out;
}

@keyframes fadeIn {
  from { opacity: 0; transform: translateX(-20px); }
  to { opacity: 1; transform: translateX(0); }
}

.comment-author {
  font-weight: 600;
  color: var(--primary-color);
  margin-bottom: 0.5rem;
  display: flex;
  align-items: center;
  gap: 0.5rem;
}

.comment-content {
  color: var(--dark-text);
  line-height: 1.6;
}

.no-comments {
  text-align: center;
  padding: 3rem;
  color: var(--neutral-color);
  font-style: italic;
}

/* Bouton flottant */
.floating-action {
  position: fixed;
  bottom: 2rem;
  right: 2rem;
  width: 60px;
  height: 60px;
  border-radius: 50%;
  background: var(--gradient-primary);
  color: white;
  border: none;
  font-size: 1.5rem;
  box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
  transition: all 0.3s ease;
  z-index: 1000;
  cursor: pointer;
}

.floating-action:hover {
  transform: scale(1.1);
  box-shadow: 0 12px 30px rgba(0, 0, 0, 0.4);
}

/* Responsive */
@media (max-width: 768px) {
  .main-container {
    margin: 1rem;
  }

  .alert-title {
    font-size: 2rem;
  }

  .content-section {
    padding: 1rem;
  }

  .image-gallery {
    grid-template-columns: 1fr;
  }
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
   </style>

</head>
<body>
    @include('partials.header')
  <div class="container mt-5">
    <!-- Header -->
    <div class="header-section">
      <div class="header-content">
        <a href="/cartesdesalertes" class="back-btn"><i class="fas fa-arrow-left"></i> Retour aux alertes</a>
        <h1 class="alert-title">{{ $alerte->title }}</h1>
        <span class="status-badge
          {{ $alerte->status === 'résolue' ? 'status-resolu' : ($alerte->status === 'en_cours' ? 'status-en-cours' : 'status-nouveau') }}">
          {{ ucfirst($alerte->status) }}
        </span>
      </div>
    </div>

    <!-- Contenu -->
    <div class="content-section">
      <!-- Infos alerte -->
      <div class="info-card">
        <h3 class="mb-4"><i class="fas fa-info-circle text-primary"></i> Informations de l'alerte</h3>

        <div class="info-item">
          <div class="info-icon icon-category"><i class="fas fa-tag"></i></div>
          <div><strong>Catégorie :</strong> <span class="ms-2">{{ $alerte->category->nom ?? 'Non catégorisée' }}</span></div>
        </div>

        <div class="info-item">
          <div class="info-icon icon-location"><i class="fas fa-map-marker-alt"></i></div>
          <div><strong>Quartier :</strong> <span class="ms-2">{{ $alerte->quartier }}</span></div>
        </div>

        <div class="info-item">
          <div class="info-icon icon-author"><i class="fas fa-user"></i></div>
          <div><strong>Signalé par :</strong> <span class="ms-2">{{ $alerte->user->name ?? 'Anonyme' }}</span></div>
        </div>

        <div class="info-item">
          <div class="info-icon icon-description"><i class="fas fa-file-alt"></i></div>
          <div><strong>Description :</strong><p class="mb-0 mt-2">{{ $alerte->description }}</p></div>
        </div>
      </div>

      <!-- Images -->
      @if($alerte->images->count())
      <div class="info-card">
        <h3 class="mb-4"><i class="fas fa-images text-primary"></i> Photos du problème</h3>
        <div class="image-gallery">
          @foreach($alerte->images as $img)
          <div class="image-item">
            <img src="{{ asset('storage/' . $img->path) }}" alt="Image de l'alerte">
          </div>
          @endforeach
        </div>
      </div>
      @endif

      <!-- Commentaires -->
      @if(session('success'))
  <div class="alert alert-success mt-3">
    {{ session('success') }}
  </div>
@endif
@forelse($alerte->commentaires as $c)
  <div class="comment-item">
    <div class="comment-author">
      <i class="fas fa-user-circle"></i> {{ $c->auteur ?? 'Anonyme' }}
    </div>
    <div class="comment-content">{{ $c->texte }}</div>
  </div>
@empty
  <div class="no-comments">Aucun commentaire pour le moment.</div>
@endforelse
@if(auth()->check())
  <div class="mt-4">
    <form action="{{ route('commentaire.store') }}" method="POST">
      @csrf
      <input type="hidden" name="alerte_id" value="{{ $alerte->id }}">
      <div class="mb-3">
        <textarea name="contenu" class="form-control" rows="3" placeholder="Ajouter un commentaire..." required></textarea>
      </div>
      <button type="submit" class="btn btn-success"><i class="fas fa-paper-plane"></i> Publier</button>
    </form>
  </div>
@else
  <p class="text-muted">Connecte-toi pour publier un commentaire.</p>
@endif
</div>
</div>
  @include('partials.footer')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
  <script>
    // Animation entrée
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.style.opacity = '1';
          entry.target.style.transform = 'translateY(0)';
        }
      });
    }, { threshold: 0.1 });

    document.querySelectorAll('.info-card, .comment-item').forEach(el => {
      el.style.opacity = '0';
      el.style.transform = 'translateY(20px)';
      el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
      observer.observe(el);
    });

    document.querySelector('.floating-action').addEventListener('click', function () {
      alert("Fonction ajout commentaire à venir.");
    });

    document.querySelectorAll('.image-item img').forEach(img => {
      img.addEventListener('click', function () {
        const modal = document.createElement('div');
        modal.style.cssText = `position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.9);display:flex;align-items:center;justify-content:center;z-index:10000;cursor:pointer;`;
        const modalImg = document.createElement('img');
        modalImg.src = this.src;
        modalImg.style.cssText = `max-width:90%;max-height:90%;object-fit:contain;border-radius:8px;`;
        modal.appendChild(modalImg);
        document.body.appendChild(modal);
        modal.addEventListener('click', () => document.body.removeChild(modal));
      });
    });

    document.querySelector('.back-btn').addEventListener('click', e => {
      e.preventDefault();
      window.history.back();
    });
  </script>
</body>
</html>

