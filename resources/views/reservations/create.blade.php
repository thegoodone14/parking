@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Demande de Nouvelle Réservation</h1>
    
    <!-- Formulaire de création de réservation -->
    <form action="{{ route('reservations.store') }}" method="POST">
        @csrf
        <!-- Champs du formulaire (par exemple) -->
        <div class="form-group">
            <label for="date">Date de la réservation</label>
            <input type="date" class="form-control" id="date" name="date">
        </div>
        <div class="form-group">
            <label for="time">Heure de la réservation</label>
            <input type="time" class="form-control" id="time" name="time">
        </div>
        <!-- Autres champs du formulaire -->
        
        <button type="submit" class="btn btn-primary">Envoyer</button>
    </form>
</div>
@endsection
