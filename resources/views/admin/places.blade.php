@extends('base')

@section('content')
<div class="container-fluid p-4">
    <!-- En-tête -->
    <div class="row mb-4">
        <div class="col-12 text-center">
            <h1 class="text-2xl font-bold mb-2">Gestion des places de parking</h1>
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

    <div class="row">
        <!-- Formulaire d'ajout -->
        <div class="col-12 col-md-4 mb-4">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h2 class="h5 m-0">Ajouter une nouvelle place</h2>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.places.store') }}">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="Numero" class="form-label">Numéro de la place</label>
                            <input type="text" 
                                   class="form-control @error('Numero') is-invalid @enderror" 
                                   id="Numero" 
                                   name="Numero" 
                                   value="{{ old('Numero') }}" 
                                   required>
                            @error('Numero')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary w-100">
                            Créer la place
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Liste des places -->
        <div class="col-12 col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h2 class="h5 m-0">Liste des places</h2>
                    <span class="badge bg-light text-dark">Total: {{ $places->count() }} places</span>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Numéro</th>
                                    <th class="text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($places as $place)
                                <tr>
                                    <td>{{ $place->ID_Place }}</td>
                                    <td>{{ $place->Numero }}</td>
                                    <td class="text-end">
                                        <button type="button" 
                                                class="btn btn-sm btn-outline-primary me-2"
                                                onclick="openEditModal('{{ $place->ID_Place }}', '{{ $place->Numero }}')">
                                            Modifier
                                        </button>
                                        <form action="{{ route('admin.places.destroy', $place->ID_Place) }}" 
                                              method="POST" 
                                              class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="btn btn-sm btn-outline-danger"
                                                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette place ?')">
                                                Supprimer
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

<!-- Modal de modification -->
<div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modifier la place</h5>
                <button type="button" class="btn-close" onclick="closeEditModal()"></button>
            </div>
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="editNumero" class="form-label">Numéro de la place</label>
                        <input type="text" 
                               class="form-control" 
                               id="editNumero" 
                               name="Numero" 
                               required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="closeEditModal()">Annuler</button>
                    <button type="submit" class="btn btn-primary">Sauvegarder</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function openEditModal(id, numero) {
        const modal = new bootstrap.Modal(document.getElementById('editModal'));
        document.getElementById('editForm').action = `/admin/places/${id}`;
        document.getElementById('editNumero').value = numero;
        modal.show();
    }

    function closeEditModal() {
        const modal = bootstrap.Modal.getInstance(document.getElementById('editModal'));
        modal.hide();
    }
</script>
@endsection