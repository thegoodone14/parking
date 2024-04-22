@extends('base')

@section('content')
    <div class="container">
        <h1>Réservations en cours</h1>
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if ($reservations->isEmpty())
            <p>Aucune réservation en cours.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>Numéro réservation</th>
                        <th>Place</th>    
                        <th>Date et heure de réservation</th>
                        <th>Date et heure d'expiration</th>
                        
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reservations as $reservation)
                        <tr>
                            <td>{{ $reservation->ID_reservation }}</td>
                            <td>{{ $reservation->place->Numero }}</td> <!-- Assurez-vous que la relation place est définie dans votre modèle Reservation -->
                            <td>{{ $reservation->Date_heure_reservation }}</td>
                            <td>{{ $reservation->Date_heure_expiration }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection