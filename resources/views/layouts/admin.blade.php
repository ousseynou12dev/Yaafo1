<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'Dashboard Admin')</title>
    <!-- Bootstrap CSS depuis CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        #sidebar {
            min-width: 250px;
            max-width: 250px;
            background-color: #343a40;
            color: white;
            height: 100vh;
        }
        #sidebar a {
            color: white;
            text-decoration: none;
        }
        #sidebar a:hover {
            background-color: #495057;
            text-decoration: none;
        }
        #content {
            flex-grow: 1;
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="d-flex">
        <nav id="sidebar" class="d-flex flex-column p-3">
            <h3 class="text-center mb-4">Admin Panel</h3>
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item mb-1">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active bg-primary' : 'text-white' }}">
                        Tableau de bord
                    </a>
                </li>
                <li class="nav-item mb-1">
                    <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->routeIs('admin.users.*') ? 'active bg-primary' : 'text-white' }}">
                        Gestion des utilisateurs
                    </a>
                </li>
                <li class="nav-item mb-1">
                    <a href="{{ route('admin.alertes.index') }}" class="nav-link {{ request()->routeIs('admin.alertes.*') ? 'active bg-primary' : 'text-white' }}">
                        Modération des alertes
                    </a>
                </li>
                <li class="nav-item mb-1">
                    <a href="{{ route('admin.parametres') }}" class="nav-link {{ request()->routeIs('admin.parametres') ? 'active bg-primary' : 'text-white' }}">
                        Paramètres
                    </a>
                </li>
            </ul>
            <hr />
            <div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-danger w-100">Déconnexion</button>
                </form>
            </div>
        </nav>

        <main id="content" class="flex-grow-1">
            @yield('content')
        </main>
    </div>

    <!-- Bootstrap JS (optionnel, pour composants) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
