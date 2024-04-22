{{-- resources/views/admin/history.blade.php --}}
@extends('base')

@section('content')
<div class="container">
    <h1>Historique des Réservations</h1>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>ID Réservation</th>
                <th>Détails</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($histories as $history)
            <tr>
                <td>{{ $history->id }}</td>
                <td>{{ $history->reservation_id }}</td>
                <td>
                    @php $details = json_decode($history->details, true); @endphp
                    <ul>
                    @foreach ($details as $key => $value)
                    @if(in_array($key, ['Date_heure_reservation', 'Date_heure_expiration']))
                        <li>{{ $key }}: {{ \Carbon\Carbon::parse($value)->format('d M Y, H:i:s') }}</li>
                    @else
                        <li>{{ $key }}: {{ $value }}</li>
                    @endif
                    @endforeach
                    </ul>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
