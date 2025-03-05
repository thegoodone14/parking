<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Place;
use App\Models\Waitlist;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth; // Importer la classe Auth

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
                // Récupérer l'utilisateur authentifié
            $user = Auth::user();

            // Supprimer les réservations antérieures à la date actuelle
        Reservation::where('Date_heure_expiration', '<', now())->delete();
        
            // Récupérer les réservations de l'utilisateur
            $reservations = Reservation::where('ID_user', $user->id)->get();

            return view('reservations.index', compact('reservations'));
     }
 
     
     // Enregistrer une nouvelle réservation dans la base de données
     public function store(Request $request)
     {
         // Récupérer l'objet utilisateur authentifié
        $user = auth()->user();
    
         // Vérifier si l'utilisateur est bloqué
        if ($user->est_bloque) {
        return redirect()->route('reservations.index')->with('error', 'Votre compte est bloqué, vous ne pouvez pas effectuer de réservation.');
        }

        // Récupérer l'ID de l'utilisateur authentifié
        $userID = auth()->user()->id;

       
    
            // Supprimer les réservations antérieures à la date actuelle
        Reservation::where('Date_heure_expiration', '<', now())->delete();
            
        // Vérifier si l'utilisateur a déjà une réservation active dont la date d'expiration est dans le futur
        $hasActiveReservation = $user->reservations()
        ->where('Date_heure_expiration', '>', now())
        ->exists();

        if ($hasActiveReservation) {
            $errorMessage = 'Vous avez déjà une réservation active.';
            return redirect()->route('reservations.index')->with('error', 'Vous avez déjà une réservation active.');
        }
        else {
       
       
        // Récupérer un ID_Place disponible
        $availablePlace = Place::whereNotExists(function ($query) {
            $query->select(DB::raw(1))
                  ->from('reservations')
                  ->whereColumn('reservations.id_place', 'places.id_place') // Changé
                  ->orWhere('reservations.date_heure_expiration', '<', now()); // Changé
        })->value('id_place'); // Changé

                // Ajouter un système de notification quand une place se libère
                if (!$availablePlace) {
                    $waitlistEntry = Waitlist::create([
                        'user_id' => $userID,
                        'rang' => Waitlist::count() + 1 // Ajouter le rang automatiquement
                    ]);
                    // Envoyer une notification à l'utilisateur avec son rang
                    return redirect()->route('waitlist');
                }
                

        // Calculer la date et l'heure actuelles
        $currentDateTime = now();

        // Calculer la date et l'heure d'expiration (1 jour à partir de maintenant)
        $expirationDateTime = $currentDateTime->copy()->addMinutes(1);

        // Créer une nouvelle réservation avec l'ID de la place disponible
        $reservation = new Reservation();
        $reservation->date_heure_reservation = $currentDateTime; // Changé
        $reservation->date_heure_expiration = $expirationDateTime; // Changé
        $reservation->id_user = $userID; // Changé
        $reservation->id_place = $availablePlace; // Changé
        $reservation->save();

        // Rediriger avec un message de succès
        return redirect()->route('reservations.index')->with('success', 'Réservation ajoutée avec succès.');
     }
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
            'date_heure_reservation' => 'required|date', // Changé
            'date_heure_expiration' => 'required|date|after:date_heure_reservation', // Changé
            'id_place' => 'required|exists:places,id_place', // Changé
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
        $waitlistEntries = Waitlist::with('user')->orderBy('created_at', 'asc')->get();

        return view('waitlist', compact('waitlistEntries'));
    }
    // Logique pour obtenir l'historique des réservations
    public function history()
    {
        $reservations = Reservation::with(['user', 'place'])
                                   ->orderBy('created_at', 'desc')
                                   ->paginate(10); // Paginer les résultats pour l'affichage

        return view('admin.history', compact('reservations'));
    }
}
