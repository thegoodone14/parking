@extends('base')

@section('content')
<div class="container">
    <h1>Liste d'Attente</h1>
    <table class="table">
    <thead>
            <tr>
                <th>ID</th>
                <th>Nom de l'Utilisateur</th>
                <th>Date d'Ajout</th>
            </tr>
        </thead>
        @foreach ($waitlistEntries as $entry)
        <tr>
                <td>{{ $entry->id }}</td>
                <td>{{ $entry->user_id }}</td>
                <td>{{ $entry->created_at}}</td>
        </tr>
        @endforeach
</table>
</div>
@endsection