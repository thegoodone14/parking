@extends('base')

@section('content')
<div class="container-fluid p-4">
    <!-- En-tête -->
    <div class="row mb-4">
        <div class="col-12 text-center">
            <h1 class="text-2xl font-bold mb-2">Liste d'attente</h1>
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

    @if(session('error'))
    <div class="row justify-content-center mb-4">
        <div class="col-12 col-md-8">
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        </div>
    </div>
    @endif

    <!-- Liste d'attente -->
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h2 class="h5 m-0">Personnes en attente</h2>
                    <span class="badge bg-light text-dark">Total: {{ $waitlistEntries->count() }} personnes</span>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nom de l'Utilisateur</th>
                                    <th>Date d'Ajout</th>
                                    <th class="text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($waitlistEntries as $entry)
                                <tr>
                                    <td>{{ $entry->id }}</td>
                                    <td>{{ $entry->user_id }}</td>
                                    <td>{{ $entry->created_at }}</td>
                                    <td class="text-end">
                                        <form action="{{ route('admin.waitlist.destroy', $entry->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger" type="submit"
                                                    onclick="return confirm('Êtes-vous sûr de vouloir retirer cette personne de la liste d'attente ?')">
                                                Retirer
                                            </button>
                                        </form>
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