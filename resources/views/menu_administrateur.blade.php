@extends('base')

@section('content')
<div class="container text-center">
    <h1 class="my-4">PARKING</h1>

    <div class="row">
        <div class="col-md-6 mb-3">
        <a href="{{ route('admin.users') }}" class="btn btn-primary">Gérer les utilisateurs</a>

        <div class="col-md-6 mb-3">
        <a href="{{ route('admin.places') }}" class="btn btn-primary">Gérer les places</a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
        <a href="{{ route('admin.reservations.history') }}" class="btn btn-primary">Consulter l'historique</a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
        <a href="{{ route('admin.waitlist') }}" class="btn btn-primary">Consulter la liste d'attente</a>
        </div>
    </div>
</div>
@endsection





