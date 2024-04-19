{{-- resources/views/admin/users.blade.php --}}
@extends('base')

@section('content')
<h2>Gérer les Utilisateurs</h2>
{{-- Tableau des utilisateurs --}}
<table>
    {{-- En-têtes de colonne --}}
    <tr>
        <th>ID</th>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Email</th>
        {{-- Autres colonnes au besoin --}}
    </tr>
    {{-- Lignes de données --}}
    @foreach ($users as $user)
    <tr>
        <td>{{ $user->id }}</td>
        <td>{{ $user->nom }}</td>
        <td>{{ $user->prenom }}</td>
        <td>{{ $user->email }}</td>
        {{-- Autres données --}}
    </tr>
    @endforeach
</table>
@endsection
