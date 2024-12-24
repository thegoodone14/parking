<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Application</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding-top: 76px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .main-content {
            flex: 1 0 auto;
        }
        .footer {
            flex-shrink: 0;
            width: 100%;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('home') }}">Accueil</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    @auth
                        <li class="nav-item">
                            <a class="nav-link{{ Request::is('dashboard') ? ' active' : '' }}" 
                               href="{{ route('dashboard') }}">Menu Utilisateur</a>
                        </li>
                        @if(auth()->user()->statut == 1)
                            <li class="nav-item">
                                <a class="nav-link{{ Request::is('admin/dashboard') ? ' active' : '' }}" 
                                   href="{{ route('admin.dashboard') }}">Menu Admin</a>
                            </li>
                        @endif
                    @endauth
                </ul>
                
                <ul class="navbar-nav">
                    @auth
                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="nav-link btn btn-link">Déconnexion</button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link{{ Request::is('login') ? ' active' : '' }}" 
                               href="{{ route('login') }}">Connexion</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link{{ Request::is('register') ? ' active' : '' }}" 
                               href="{{ route('register') }}">Inscription</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <main class="main-content py-4">
        @yield('content')
    </main>

    <footer class="footer bg-light py-3 mt-auto">
        <div class="container text-center">
            <p class="mb-0">&copy; {{ date('Y') }} Mon Application. Tous droits réservés.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>