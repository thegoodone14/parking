
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <div class="container">
        <h1>Réservations en cours</h1>
        @if ($reservations->isEmpty())
            <p>Aucune réservation en cours.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>Date et heure de réservation</th>
                        <th>Date et heure d'expiration</th>
                        <th>Place</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reservations as $reservation)
                        <tr>
                            <td>{{ $reservation->Date_heure_reservation }}</td>
                            <td>{{ $reservation->Date_heure_expiration }}</td>
                            <td>{{ $reservation->place->Numero }}</td> <!-- Assurez-vous que la relation place est définie dans votre modèle Reservation -->
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</html>