<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function __construct()
    {
    }

    // Créer une place 
    public function create()
    {
        return view('reservations.create');
    }
    // Afficher les réservations de l'utilisateur connecté
     public function index()
     {
         $reservations = auth()->user()->reservations;
         return view('reservations.index', compact('reservations'));
     }
 
     // Enregistrer une nouvelle réservation dans la base de données
     public function store(Request $request)
     {
        // Récupérer l'ID de l'utilisateur authentifié
        $userID = auth()->user()->id;

        // Calculer la date et l'heure actuelles
        $currentDateTime = now();

        // Calculer la date et l'heure d'expiration (1 jour à partir de maintenant)
        $expirationDateTime = $currentDateTime->copy()->addDay();

        // Créer une nouvelle réservation avec les données par défaut
        $reservation = new Reservation();
        $reservation->Date_heure_reservation = $currentDateTime;
        $reservation->Date_heure_expiration = $expirationDateTime;
        $reservation->ID_user = $userID;
        $reservation->ID_Place = $request->input('ID_Place'); // Vous devez encore récupérer l'ID de la place à partir de la demande
        $reservation->save();

        // Rediriger avec un message de succès
        return redirect()->route('reservations.index')->with('success', 'Réservation ajoutée avec succès.');

     }
    
     // Afficher une réservation spécifique
    public function show($id)
    {
        $reservation = Reservation::with('place', 'user')->findOrFail($id);
        return view('reservations.show', compact('reservation'));
    }

    // Afficher le formulaire pour éditer une réservation existante
    public function edit($id)
    {
        $reservation = Reservation::findOrFail($id);
        $places = Place::all(); // Récupérer toutes les places pour sélectionner lors de la modification
        return view('reservations.edit', compact('reservation', 'places'));
    }

    // Mettre à jour la réservation dans la base de données
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'Date_heure_reservation' => 'required|date',
            'Date_heure_expiration' => 'required|date|after:Date_heure_reservation',
            'ID_Place' => 'required|exists:places,ID_Place',
        ]);

        $reservation = Reservation::findOrFail($id);
        $reservation->update($validatedData);

        return redirect()->route('reservations.index')->with('success', 'Réservation mise à jour avec succès.');
    }

    // Supprimer la réservation de la base de données
    public function destroy($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->delete();

        return redirect()->route('reservations.index')->with('success', 'Réservation supprimée avec succès.');
    }

    // Logique pour obtenir les données de la liste d'attente
    public function waitlist() {
        return view('reservations.waitlist', compact('data'));
    }
}
