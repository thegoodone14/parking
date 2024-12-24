<?php

namespace App\Http\Controllers;

use App\Models\Place;
use App\Models\Reservation;
use Illuminate\Http\Request;

class PlaceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        // Vérification du statut admin pour certaines routes
        $this->middleware(function ($request, $next) {
            if (auth()->user()->statut != 1) {
                abort(403, 'Accès non autorisé.');
            }
            return $next($request);
        })->only(['store', 'edit', 'update', 'destroy']);
    }

    public function index()
    {
        $places = Place::withCount(['reservations' => function ($query) {
            $query->where('Date_heure_expiration', '>', now());
        }])->get();
        
        return view('admin.places', compact('places'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'Numero' => 'required|string|unique:places,Numero',
        ]);

        Place::create([
            'Numero' => $request->Numero,
        ]);

        return redirect()->route('admin.places')->with('success', 'Place ajoutée avec succès.');
    }

    public function edit(Place $place)
    {
        return view('admin.places.edit', compact('place'));
    }

    public function update(Request $request, Place $place)
    {
        $request->validate([
            'Numero' => 'required|string|unique:places,Numero,' . $place->ID_Place . ',ID_Place',
        ]);

        $place->update([
            'Numero' => $request->Numero,
        ]);

        return redirect()->route('admin.places')->with('success', 'Place mise à jour avec succès.');
    }

    public function destroy($id)
    {
        $place = Place::findOrFail($id);
        
        // Vérifier si la place a des réservations actives
        $hasActiveReservations = $place->reservations()
            ->where('Date_heure_expiration', '>', now())
            ->exists();

        if ($hasActiveReservations) {
            return redirect()->route('admin.places')
                ->with('error', 'Impossible de supprimer une place avec des réservations actives.');
        }

        $place->delete();

        return redirect()->route('admin.places')
            ->with('success', 'Place supprimée avec succès.');
    }

    // Récupérer les statistiques des places
    public function getStats()
    {
        $stats = [
            'total' => Place::count(),
            'occupied' => Reservation::where('Date_heure_expiration', '>', now())->count(),
            'available' => Place::count() - Reservation::where('Date_heure_expiration', '>', now())->count(),
        ];

        return response()->json($stats);
    }
}