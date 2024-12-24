@extends('base')

@section('content')
<div class="container-fluid p-4">
    <!-- En-tête -->
    <div class="row mb-4">
        <div class="col-12 text-center">
            <h1 class="text-2xl font-bold mb-2">Historique des réservations</h1>
        </div>
    </div>

    <!-- Messages -->
    @if(session('success'))
    <div class="row justify-content-center mb-4">
        <div class="col-12 col-md-8">
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        </div>
    </div>
    @endif

    <!-- Historique -->
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h2 class="h5 m-0">Détails des réservations</h2>
                    <span class="badge bg-light text-dark">Total: {{ $histories->count() }} entrées</span>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>ID Réservation</th>
                                    <th>Détails</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($histories as $history)
                                <tr>
                                    <td>{{ $history->id }}</td>
                                    <td>{{ $history->reservation_id }}</td>
                                    <td>
                                        @php $details = json_decode($history->details, true); @endphp
                                        <div class="card bg-light">
                                            <div class="card-body p-2">
                                                <ul class="list-unstyled mb-0">
                                                    @foreach($details as $key => $value)
                                                        @if(in_array($key, ['Date_heure_reservation', 'Date_heure_expiration']))
                                                            <li><strong>{{ $key }}:</strong> {{ \Carbon\Carbon::parse($value)->format('d M Y, H:i:s') }}</li>
                                                        @else
                                                            <li><strong>{{ $key }}:</strong> {{ $value }}</li>
                                                        @endif
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection