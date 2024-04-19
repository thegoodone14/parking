@extends('base')

@section('content')
<div class="container">
    <h1 class="my-4">PARKING</h1>
    <div class="list-group">
            <a href="{{ route('reservations.create') }}" class="list-group-item list-group-item-action">Demander une nouvelle réservation</a>
            <a href="{{ route('reservations.index') }}" class="list-group-item list-group-item-action">Réservation en cours</a>
            <a href="{{ route('waitlist') }}" class="list-group-item list-group-item-action">Liste d'attente</a>
    </div>
</div>
@endsection
