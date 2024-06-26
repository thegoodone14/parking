@extends('layouts.app')

@section('content')
<div class="container text-center">
    <h1 class="my-4">PARKING</h1>

    <div class="row">
        <div class="col-md-6 mb-3">
            <a href="{{ route('reservations.create') }}" class="btn btn-primary btn-lg btn-block">Demander une nouvelle réservation</a>
        </div>

        <div class="col-md-6 mb-3">
            <a href="{{ route('reservations.index') }}" class="btn btn-primary btn-lg btn-block">Réservation en cours</a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <a href="{{ route('waitlist') }}" class="btn btn-primary btn-lg btn-block">Liste d'attente</a>
        </div>
    </div>
</div>
@endsection
