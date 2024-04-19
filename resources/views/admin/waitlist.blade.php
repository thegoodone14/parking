{{-- resources/views/admin/waitlist/index.blade.php --}}
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
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($waitlistEntries as $entry)
            <tr>
                <td>{{ $entry->id }}</td>
                <td>{{ $entry->user_id }}</td>
                <td>{{ $entry->created_at}}</td>
                <td>
                    <!-- Bouton pour retirer de la liste d'attente -->
                    <form action="{{ route('admin.waitlist.destroy', $entry->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" type="submit">Retirer</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
