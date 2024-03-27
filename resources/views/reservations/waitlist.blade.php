{{-- resources/views/reservations/waitlist.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<div class="container">
    <h1>Liste d'Attente</h1>
    <ul>
        @foreach ($waitlistEntries as $entry)
            <li>{{ $entry->user->name }} - Ajouté le : {{ $entry->created_at }}</li>
        @endforeach
    </ul>
</div>
</html>

