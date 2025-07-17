<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Footer YAAFO</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">


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

body {
  font-family: 'Inter', sans-serif;
  margin: 0;
  padding: 0;
  background: #f8fafc;
  min-height: 100vh;
  display: flex;
  flex-direction: column;
}

.content {
  flex: 1;
  padding: 50px 0;
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  color: white;
  text-align: center;
}

/* Footer Styles */
.footer {
  background: var(--gradient-dark);
  color: white;
  position: relative;
  overflow: hidden;
}

.footer::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 1px;
  background: linear-gradient(90deg, transparent, var(--primary-color), transparent);
}

.footer-top {
  padding: 4rem 0 2rem;
  position: relative;
}

.footer-brand {
  margin-bottom: 2rem;
}

.footer-logo {
  font-family: 'Poppins', sans-serif;
  font-size: 2.5rem;
  font-weight: 800;
  background: var(--gradient-primary);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
  text-decoration: none;
  display: inline-block;
}

.footer-tagline {
  font-size: 1.1rem;
  color: var(--text-muted);
  margin-bottom: 1rem;
  font-weight: 500;
}

.footer-description {
  font-size: 1rem;
  line-height: 1.7;
  color: #b0bec5;
  margin-bottom: 2rem;
  max-width: 400px;
}

.social-links {
  display: flex;
  gap: 1rem;
  justify-content: flex-start;
}

.social-link {
  width: 50px;
  height: 50px;
  border-radius: 50%;
  background: rgba(255, 255, 255, 0.1);
  backdrop-filter: blur(10px);
  border: 1px solid rgba(255, 255, 255, 0.2);
  display: flex;
  align-items: center;
  justify-content: center;
  color: white;
  text-decoration: none;
  font-size: 1.2rem;
  transition: all 0.3s ease;
  position: relative;
  overflow: hidden;
}

.social-link::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: var(--gradient-primary);
  transform: scale(0);
  transition: transform 0.3s ease;
  border-radius: 50%;
}

.social-link:hover::before {
  transform: scale(1);
}

.social-link:hover {
  transform: translateY(-5px);
  box-shadow: 0 10px 30px rgba(92, 210, 198, 0.4); /* turquoise */
}

.social-link i {
  position: relative;
  z-index: 1;
}

.footer-section {
  margin-bottom: 2rem;
}

.footer-title {
  font-family: 'Poppins', sans-serif;
  font-size: 1.3rem;
  font-weight: 600;
  margin-bottom: 1.5rem;
  color: white;
  position: relative;
  padding-bottom: 0.5rem;
}

.footer-title::after {
  content: '';
  position: absolute;
  bottom: 0;
  left: 0;
  width: 50px;
  height: 3px;
  background: var(--gradient-primary);
  border-radius: 2px;
}

.footer-links {
  list-style: none;
  padding: 0;
  margin: 0;
}

.footer-links li {
  margin-bottom: 0.75rem;
}

.footer-links a {
  color: #a0aec0;
  text-decoration: none;
  font-size: 0.95rem;
  transition: all 0.3s ease;
  display: inline-block;
  position: relative;
}

.footer-links a::before {
  content: '';
  position: absolute;
  bottom: -2px;
  left: 0;
  width: 0;
  height: 2px;
  background: var(--gradient-primary);
  transition: width 0.3s ease;
}

.footer-links a:hover {
  color: var(--secondary-color);
  transform: translateX(5px);
}

.footer-links a:hover::before {
  width: 100%;
}

.contact-info {
  margin-bottom: 2rem;
}

.contact-item {
  display: flex;
  align-items: center;
  margin-bottom: 1rem;
  padding: 0.75rem;
  background: rgba(255, 255, 255, 0.05);
  border-radius: 12px;
  border: 1px solid rgba(255, 255, 255, 0.1);
  transition: all 0.3s ease;
}

.contact-item:hover {
  background: rgba(255, 255, 255, 0.1);
  transform: translateY(-2px);
}

.contact-icon {
  width: 40px;
  height: 40px;
  border-radius: 50%;
  background: var(--gradient-primary);
  display: flex;
  align-items: center;
  justify-content: center;
  color: white;
  font-size: 1.1rem;
  margin-right: 1rem;
  flex-shrink: 0;
}

.contact-text {
  flex: 1;
}

.contact-label {
  font-size: 0.85rem;
  color: var(--text-muted);
  margin-bottom: 0.25rem;
}

.contact-value {
  font-size: 1rem;
  color: #e0e6f1;
  font-weight: 500;
}

.newsletter {
  margin-top: 2rem;
}

.newsletter-form {
  display: flex;
  gap: 0.5rem;
  margin-top: 1rem;
}

.newsletter-input {
  flex: 1;
  padding: 0.75rem 1rem;
  border: 1px solid rgba(255, 255, 255, 0.2);
  border-radius: 50px;
  background: rgba(255, 255, 255, 0.1);
  backdrop-filter: blur(10px);
  color: white;
  font-size: 0.95rem;
  transition: all 0.3s ease;
}

.newsletter-input::placeholder {
  color: rgba(255, 255, 255, 0.6);
}

.newsletter-input:focus {
  outline: none;
  border-color: var(--primary-color);
  box-shadow: 0 0 0 3px rgba(92, 210, 198, 0.2); /* turquoise */
}

.newsletter-btn {
  padding: 0.75rem 1.5rem;
  background: var(--gradient-primary);
  color: white;
  border: none;
  border-radius: 50px;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.3s ease;
  white-space: nowrap;
}

.newsletter-btn:hover {
  transform: translateY(-2px);
  box-shadow: 0 8px 25px rgba(92, 210, 198, 0.4);
}

.stats-section {
  background: rgba(255, 255, 255, 0.05);
  backdrop-filter: blur(10px);
  padding: 2rem;
  border-radius: 20px;
  margin-bottom: 2rem;
  border: 1px solid rgba(255, 255, 255, 0.1);
}

.stats-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
  gap: 1.5rem;
  text-align: center;
}

.stat-item {
  padding: 1rem;
}

.stat-number {
  font-size: 2rem;
  font-weight: 800;
  color: var(--primary-color);
  margin-bottom: 0.5rem;
  font-family: 'Poppins', sans-serif;
}

.stat-label {
  font-size: 0.9rem;
  color: var(--text-muted);
}

.footer-bottom {
  padding: 2rem 0;
  background: rgba(0, 0, 0, 0.3);
  border-top: 1px solid rgba(255, 255, 255, 0.1);
}

.footer-bottom-content {
  display: flex;
  justify-content: space-between;
  align-items: center;
  flex-wrap: wrap;
  gap: 1rem;
}

.copyright {
  color: var(--text-muted);
  font-size: 0.9rem;
}

.credits {
  color: var(--text-muted);
  font-size: 0.9rem;
}

.credits .heart {
  color: var(--primary-color);
  animation: heartbeat 2s infinite;
}

@keyframes heartbeat {
  0%, 100% { transform: scale(1); }
  50% { transform: scale(1.1); }
}

.footer-decorations {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  pointer-events: none;
  overflow: hidden;
}

.decoration-circle {
  position: absolute;
  border-radius: 50%;
  background: rgba(92, 210, 198, 0.05); /* turquoise clair, transparent */
  animation: float 20s infinite linear;
}

.decoration-circle:nth-child(1) {
  width: 100px;
  height: 100px;
  top: 20%;
  left: 10%;
  animation-delay: 0s;
}

.decoration-circle:nth-child(2) {
  width: 150px;
  height: 150px;
  top: 60%;
  right: 15%;
  animation-delay: 5s;
}

.decoration-circle:nth-child(3) {
  width: 80px;
  height: 80px;
  top: 80%;
  left: 70%;
  animation-delay: 10s;
}

@keyframes float {
  0%, 100% { transform: translateY(0px) rotate(0deg); }
  50% { transform: translateY(-20px) rotate(180deg); }
}

/* Responsive */
@media (max-width: 768px) {
  .footer-top {
    padding: 3rem 0 1.5rem;
  }

  .footer-logo {
    font-size: 2rem;
  }

  .newsletter-form {
    flex-direction: column;
  }

  .newsletter-btn {
    width: 100%;
  }

  .footer-bottom-content {
    flex-direction: column;
    text-align: center;
  }

  .stats-grid {
    grid-template-columns: repeat(2, 1fr);
  }

  .social-links {
    justify-content: center;
  }

  .footer-title::after {
    left: 50%;
    transform: translateX(-50%);
  }
}
</style>
</head>
<body>
  <!-- Demo content -->

  <!-- Footer -->
  <footer class="footer">
    <div class="footer-decorations">
      <div class="decoration-circle"></div>
      <div class="decoration-circle"></div>
      <div class="decoration-circle"></div>
    </div>

    <div class="footer-top">
      <div class="container">
        <div class="row">
          <!-- Brand Section -->
          <div class="col-lg-4 col-md-12">
            <div class="footer-brand">
              <a href="#" class="footer-logo">YAAFO</a>
              <p class="footer-tagline">Ensemble pour un quartier meilleur</p>
              <p class="footer-description">
                YAAFO est une plateforme communautaire qui permet aux citoyens de signaler rapidement les problèmes de leur quartier pour une prise en charge rapide et efficace.
              </p>
              <div class="social-links">
                <a href="#" class="social-link">
                  <i class="bi bi-facebook"></i>
                </a>
                <a href="#" class="social-link">
                  <i class="bi bi-twitter-x"></i>
                </a>
                <a href="#" class="social-link">
                  <i class="bi bi-instagram"></i>
                </a>
                <a href="#" class="social-link">
                  <i class="bi bi-linkedin"></i>
                </a>
                <a href="#" class="social-link">
                  <i class="bi bi-youtube"></i>
                </a>
              </div>
            </div>
          </div>

          <!-- Navigation Links -->
          <div class="col-lg-2 col-md-6">
            <div class="footer-section">
              <h4 class="footer-title">Navigation</h4>
              <ul class="footer-links">
                <li><a href="#hero">Accueil</a></li>
                <li><a href="#how-it-works">Comment ça marche</a></li>
                <li><a href="#geolocalisation-alertes">Carte des alertes</a></li>
                <li><a href="#recent-alerts">Alertes récentes</a></li>
                <li><a href="#contact">Contact</a></li>
              </ul>
            </div>
          </div>

          <!-- Services -->
          <div class="col-lg-2 col-md-6">
            <div class="footer-section">
              <h4 class="footer-title">Services</h4>
              <ul class="footer-links">
                <li><a href="#signaler">Signaler un problème</a></li>
                <li><a href="#suivre-alertes">Suivre les alertes</a></li>
                <li><a href="#agir-ensemble">Agir ensemble</a></li>
                <li><a href="#communaute">Communauté</a></li>
                <li><a href="#statistiques">Statistiques</a></li>
              </ul>
            </div>
          </div>

          <!-- Contact & Newsletter -->
          <div class="col-lg-4 col-md-12">
            <div class="footer-section">
              <h4 class="footer-title">Restons connectés</h4>
              <div class="contact-info">
                <div class="contact-item">
                  <div class="contact-icon">
                    <i class="bi bi-geo-alt"></i>
                  </div>
                  <div class="contact-text">
                    <div class="contact-label">Adresse</div>
                    <div class="contact-value">Dakar, Sénégal</div>
                  </div>
                </div>
                <div class="contact-item">
                  <div class="contact-icon">
                    <i class="bi bi-phone"></i>
                  </div>
                  <div class="contact-text">
                    <div class="contact-label">Téléphone</div>
                    <div class="contact-value">+221 77 836 72 74</div>
                  </div>
                </div>
                <div class="contact-item">
                  <div class="contact-icon">
                    <i class="bi bi-envelope"></i>
                  </div>
                  <div class="contact-text">
                    <div class="contact-label">Email</div>
                    <div class="contact-value">contact@yaafo.sn</div>
                  </div>
                </div>
              </div>

              <div class="newsletter">
                <h5 style="color: white; margin-bottom: 1rem;">📧 Newsletter</h5>
                <p style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 1rem;">
                  Recevez les dernières actualités de votre quartier
                </p>
                <form class="newsletter-form">
                  <input
                    type="email"
                    class="newsletter-input"
                    placeholder="Votre email"
                    required
                  >
                  <button type="submit" class="newsletter-btn">
                    <i class="bi bi-send"></i>
                  </button>
                </form>
              </div>
            </div>
          </div>
        </div>

        <!-- Stats Section -->
        <div class="stats-section">
          <div class="stats-grid">
            <div class="stat-item">
              <div class="stat-number">2,547</div>
              <div class="stat-label">Alertes traitées</div>
            </div>
            <div class="stat-item">
              <div class="stat-number">89%</div>
              <div class="stat-label">Taux de résolution</div>
            </div>
            <div class="stat-item">
              <div class="stat-number">15,632</div>
              <div class="stat-label">Utilisateurs actifs</div>
            </div>
            <div class="stat-item">
              <div class="stat-number">127</div>
              <div class="stat-label">Quartiers couverts</div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="footer-bottom">
      <div class="container">
        <div class="footer-bottom-content">
          <div class="copyright">
            © 2024 <strong>YAAFO</strong> - Tous droits réservés
          </div>
          <div class="credits">
            Conçu avec <span class="heart">❤️</span> par <strong>Ousseynou Diagne</strong>
          </div>
        </div>
      </div>
    </div>
  </footer>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
  <script>
    // Newsletter form submission
    document.querySelector('.newsletter-form').addEventListener('submit', function(e) {
      e.preventDefault();
      const email = this.querySelector('.newsletter-input').value;
      if (email) {
        // Simulate success
        const btn = this.querySelector('.newsletter-btn');
        const originalHTML = btn.innerHTML;
        btn.innerHTML = '<i class="bi bi-check-circle"></i>';
        btn.style.background = '#10b981';

        setTimeout(() => {
          btn.innerHTML = originalHTML;
          btn.style.background = '';
          this.querySelector('.newsletter-input').value = '';
        }, 2000);
      }
    });

    // Smooth scrolling for footer links
    document.querySelectorAll('.footer-links a[href^="#"]').forEach(anchor => {
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

    // Add some interactivity to stats
    function animateStats() {
      const statNumbers = document.querySelectorAll('.stat-number');
      statNumbers.forEach(stat => {
        const finalValue = stat.textContent;
        const isPercentage = finalValue.includes('%');
        const numValue = parseInt(finalValue.replace(/[^\d]/g, ''));

        let current = 0;
        const increment = numValue / 50;
        const timer = setInterval(() => {
          current += increment;
          if (current >= numValue) {
            stat.textContent = finalValue;
            clearInterval(timer);
          } else {
            stat.textContent = Math.floor(current).toLocaleString() + (isPercentage ? '%' : '');
          }
        }, 50);
      });
    }

    // Trigger stats animation when footer is in view
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          animateStats();
          observer.unobserve(entry.target);
        }
      });
    });

    observer.observe(document.querySelector('.stats-section'));
  </script>
</body>
</html>
