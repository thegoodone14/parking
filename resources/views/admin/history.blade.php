{{-- resources/views/admin/history.blade.php --}}
@extends('base')

@section('content')
<div class="container">
    <h1>Historique des Réservations</h1>
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Utilisateur</th>
                <th>Place</th>
                <th>Date de Réservation</th>
                <th>Date d'Expiration</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reservations as $reservation)
            <tr>
                <td>{{ $reservation->ID_reservation }}</td>
                <td>{{ $reservation->user->id ?? 'Utilisateur supprimé' }}</td>
                <td>{{ $reservation->place->ID_Place ?? 'Place supprimée' }}</td>
                <td>{{ $reservation->Date_heure_reservation ?? 'Date non disponible' }}</td>
                <td>{{ $reservation->Date_heure_expiration }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $reservations->links() }} <!-- Pagination links -->
</div>
@endsection
