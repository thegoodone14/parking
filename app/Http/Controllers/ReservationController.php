<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReservationController extends Controller
{
     // Afficher les réservations de l'utilisateur connecté
     public function index()
     {
         $reservations = auth()->user()->reservations;
         return view('reservations.index', compact('reservations'));
     }
 
     // Enregistrer une nouvelle réservation dans la base de données
     public function store(Request $request)
     {
         $validatedData = $request->validate([
             'Date_heure_reservation' => 'required|date',
             'Date_heure_expiration' => 'required|date|after:Date_heure_reservation',
             'ID_Place' => 'required|exists:places,ID_Place',
         ]);
 
         $reservation = new Reservation($validatedData);
         $reservation->ID_user = auth()->user()->id;
         $reservation->save();
 
         return redirect()->route('reservations.index')->with('success', 'Réservation ajoutée avec succès.');
     }
}
