<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PlaceController extends Controller
{
    // Afficher la liste des places
    public function index()
    {
        $places = Place::all();
        return view('places.index', compact('places'));
    }

    // Afficher le formulaire de création d'une nouvelle place
    public function create()
    {
        return view('places.create');
    }

    // Enregistrer une nouvelle place dans la base de données
    public function store(Request $request)
    {
        // Valider les données du formulaire
    $validatedData = $request->validate([
        'user_id' => 'required|exists:users,id',
    ]);

    // Vérifier s'il existe une place disponible
    $place = Place::first();

    // Créer une nouvelle réservation si une place est disponible
    if ($place) {
        // Créer une nouvelle réservation avec l'ID de l'utilisateur et l'ID de la place
        Reservation::create([
            'user_id' => $validatedData['user_id'],
            'place_id' => $place->id,
        ]);

        // Rediriger avec un message de succès
        return redirect()->route('reservations.index')->with('success', 'Réservation effectuée avec succès.');
    } else {
        // Rediriger avec un message d'erreur
        return redirect()->back()->with('error', 'Aucune place disponible pour effectuer la réservation.');
    }
    }
    // Afficher le formulaire pour éditer une place existante
    public function edit($id)
    {
        $place = Place::findOrFail($id);
        return view('places.edit', compact('place'));
    }

    // Mettre à jour la place dans la base de données
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'Numero' => 'required|max:255|unique:places,Numero,' . $id,
        ]);

        $place = Place::findOrFail($id);
        $place->update($validatedData);

        return redirect()->route('places.index')->with('success', 'Place mise à jour avec succès.');
    }

    // Supprimer la place de la base de données
    public function destroy($id)
    {
        $place = Place::findOrFail($id);
        $place->delete();

        return redirect()->route('places.index')->with('success', 'Place supprimée avec succès.');
    }
    
}
