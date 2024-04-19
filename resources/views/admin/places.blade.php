{{-- resources/views/admin/places.blade.php --}}
@extends('base')

@section('content')
<div class="container mt-4">
    <h1>Gérer les Places</h1>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Numéro</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($places as $place)
            <tr>
                <td>{{ $place->ID_Place }}</td>
                <td>{{ $place->Numero }}</td>
                <td>{{ $place->status }}</td>
                <td>
                    <!-- <a href="{{ route('admin.places.edit', ['id' => $place->id]) }}" class="btn btn-sm btn-primary">Éditer</a> -->
                    <form action="{{ route('admin.places.destroy', $place->ID_Place) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr ?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Supprimer</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
