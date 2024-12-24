@extends('base')

@section('content')
<div class="container-fluid">
    <!-- En-tête -->
    <div class="row mb-4">
        <div class="col-12 text-center">
            <h1>Tableau de bord de l'Administrateur</h1>
        </div>
    </div>

    <!-- Cartes des fonctionnalités -->
    <div class="row g-4 mb-4">
        <!-- Utilisateurs -->
        <div class="col-12 col-md-6 col-lg-4">
            <div class="card h-100">
                <div class="card-header bg-primary text-white">
                    <h2 class="h5 m-0">Utilisateurs</h2>
                </div>
                <div class="card-body d-flex flex-column">
                    <p class="flex-grow-1">Gérer les comptes utilisateurs, leurs droits et leurs accès.</p>
                    <a href="/admin/users" class="btn btn-outline-primary mt-auto">Gérer les Utilisateurs</a>
                </div>
            </div>
        </div>

        <!-- Places -->
        <div class="col-12 col-md-6 col-lg-4">
            <div class="card h-100">
                <div class="card-header bg-primary text-white">
                    <h2 class="h5 m-0">Places</h2>
                </div>
                <div class="card-body d-flex flex-column">
                    <p class="flex-grow-1">Gérer les places de parking, leur disponibilité et leur attribution.</p>
                    <a href="/admin/places" class="btn btn-outline-primary mt-auto">Gérer les Places</a>
                </div>
            </div>
        </div>

        <!-- Historique -->
        <div class="col-12 col-md-6 col-lg-4">
            <div class="card h-100">
                <div class="card-header bg-primary text-white">
                    <h2 class="h5 m-0">Historique</h2>
                </div>
                <div class="card-body d-flex flex-column">
                    <p class="flex-grow-1">Consulter l'historique complet des réservations effectuées.</p>
                    <a href="/admin/history" class="btn btn-outline-primary mt-auto">Voir l'Historique</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection