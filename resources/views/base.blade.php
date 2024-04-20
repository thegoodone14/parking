<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Application</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <nav>
        <ul>
            <li><a href="{{ url('/') }}">Accueil</a></li>
            <li><a href="{{ url('/dashboard') }}">Dashboard</a></li>
            <li><a href="{{ url('/menu-utilisateur') }}">Menu Utilisateur</a></li>
            @if(auth()->check() && auth()->user()->statut == 1)
                <li><a href="{{ url('/admin/dashboard') }}">Menu Admin</a></li>
            @endif
        </ul>
    </nav>

    <div>
        @yield('content')
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
