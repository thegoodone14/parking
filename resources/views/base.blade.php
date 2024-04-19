<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Application</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Accueil</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <!-- <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/">Accueil</a>
                </li> 
                <li class="nav-item">
                    <a class="nav-link" href="/dashboard">Dashboard</a>
                </li> -->
                @if(auth()->check())
                <li class="nav-item">
                    <a class="nav-link" href="/menu-utilisateur">Menu Utilisateur</a>
                </li>
                <!-- Le lien Menu Admin ne s'affiche que si l'utilisateur a un statut de '1' -->
                @if(auth()->user()->statut == 1)
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/dashboard">Menu Admin</a>
                    </li>
                @endif
                    <li class="nav-item">
                            <a class="nav-link" href="/dashboard">Déconnexion</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="/login">Connexion</a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    @yield('content')
</div>

<!-- Inclure Bootstrap JS 
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>-->
</body>
</html>