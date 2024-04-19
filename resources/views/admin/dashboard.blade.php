@extends('base')

@section('content')
<div class="container">
    <h1>Tableau de bord de l'Administrateur</h1>
    <div class="list-group">
        <a href="{{ route('admin.users') }}" class="list-group-item list-group-item-action">Gérer les Utilisateurs</a>
        <a href="{{ route('admin.places') }}" class="list-group-item list-group-item-action">Gérer les Places</a>
        <a href="{{ route('admin.history') }}" class="list-group-item list-group-item-action">Historique des Réservations</a>
        <a href="{{ route('admin.waitlist') }}" class="list-group-item list-group-item-action">Gérer la Liste d'Attente</a>
    </div>
</div>
 @endsection