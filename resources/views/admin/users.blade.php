@extends('base')

@section('content')
<div class="container">
    <!-- En-tête -->
    <div class="mb-4">
        <h1 class="text-center">Gestion des utilisateurs</h1>
    </div>

    <!-- Messages -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <!-- Liste des utilisateurs -->
    <div class="card">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Liste des utilisateurs</h5>
            <span class="badge bg-light text-dark">Total: {{ $users->count() }}</span>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Email</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->nom }}</td>
                            <td>{{ $user->prenom }}</td>
                            <td>{{ $user->email }}</td>
                            <td class="text-end">
                                <div class="btn-group">
                                    <form action="{{ route('admin.users.toggleBlock', $user->id) }}" method="POST" class="me-2">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-sm {{ $user->est_bloque ? 'btn-success' : 'btn-warning' }}">
                                            {{ $user->est_bloque ? 'Débloquer' : 'Bloquer' }}
                                        </button>
                                    </form>
                                    @if($user->statut != 1)
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" 
                                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')">
                                            Supprimer
                                        </button>
                                    </form>
                                    @endif
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
@endsection