{{-- resources/views/admin/users.blade.php --}}
@extends('base')

@section('content')
<h2>Gérer les Utilisateurs</h2>
@if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
<table>
    <tr>
        <th>ID</th>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Email</th>
        <th>Bloquer/Débloquer</th>
    </tr>
    @foreach ($users as $user)
    <tr>
        <td>{{ $user->id }}</td>
        <td>{{ $user->nom }}</td>
        <td>{{ $user->prenom }}</td>
        <td>{{ $user->email }}</td>
        <td>
            <form action="{{ route('admin.users.toggleBlock', $user->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <button type="submit" class="btn {{ $user->est_bloque ? 'btn-success' : 'btn-warning' }}">
                    {{ $user->est_bloque ? 'Débloquer' : 'Bloquer' }}
                </button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection
