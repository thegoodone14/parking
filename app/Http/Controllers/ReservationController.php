<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Place;
use Illuminate\Support\Facades\DB;

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

        // Récupérer un ID_Place disponible
        $availablePlace = Place::whereNotExists(function ($query) {
            $query->select(DB::raw(1))
                  ->from('reservations')
                  ->whereColumn('reservations.ID_Place', 'places.ID_Place')
                  ->orWhere('reservations.Date_heure_expiration', '<', now());
                })->value('ID_Place');

        if (!$availablePlace) {
            // Aucune place disponible
            return ('error, Aucune place disponible pour effectuer la réservation.');
        }

        // Calculer la date et l'heure actuelles
        $currentDateTime = now();

        // Calculer la date et l'heure d'expiration (1 jour à partir de maintenant)
        $expirationDateTime = $currentDateTime->copy()->addDay();

        // Créer une nouvelle réservation avec l'ID de la place disponible
        $reservation = new Reservation();
        $reservation->Date_heure_reservation = $currentDateTime;
        $reservation->Date_heure_expiration = $expirationDateTime;
        $reservation->ID_user = $userID;
        $reservation->ID_Place = $availablePlace;
        $reservation->save();

        // Rediriger avec un message de succès
        return ('success, Réservation ajoutée avec succès.');
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
