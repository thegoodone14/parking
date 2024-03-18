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
        $validatedData = $request->validate([
            'Numero' => 'required|unique:places|max:255',
        ]);

        $place = Place::create($validatedData);

        return redirect()->route('places.index')->with('success', 'Place ajoutée avec succès.');
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
