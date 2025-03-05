<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Place;
use App\Models\Waitlist;
use App\Models\Reservation;



class AdminController extends Controller
{
    // Fonction pour afficher la liste des utilisateurs
    public function users()
    {
        $users = User::all();
        return view('admin.users', compact('users'));
    }

    // Fonction pour afficher la liste des places
    public function places()
    {
        $places = Place::all();
        return view('admin.places', compact('places'));
    }

    // Fonction pour afficher l'historique des places
    public function placesHistory()
    {
        $placesHistory = Place::with('reservations')->get(); // Assurez-vous que le modèle Place a une relation 'reservations'
        return view('admin.places-history', compact('placesHistory'));
    }

    // Fonction pour gérer la liste d'attente
    public function waitlist()
    {
        $waitlistEntries = Waitlist::with('user')->orderBy('created_at', 'asc')->get();
        return view('admin.waitlist', compact('waitlistEntries'));
    }
    // Logique pour obtenir l'historique des réservations
    public function history()
    {
        $reservations = Reservation::with(['user', 'place'])
                                    ->orderBy('created_at', 'desc')
                                    ->paginate(10); // Paginer les résultats pour l'affichage

        return view('admin.history', compact('reservations'));
    }
    // Fonction pour supprimer un utilisateur de la liste d'attente 
    public function destroy($id)
    {
    
        $entry = Waitlist::findOrFail($id);
        $entry->delete();

        return redirect()->route('admin.waitlist')->with('success', 'Entrée supprimée avec succès de la liste d attente.');
    }

    public function toggleBlock(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->est_bloque = !$user->est_bloque;
        $user->save();
        if ($user->est_bloque) {
            // Changé en minuscules
            $user->reservations()->where('date_heure_expiration', '>', now())->delete();
        }
        return back()->with('success', $user->est_bloque ? 'Utilisateur bloqué avec succès.' : 'Utilisateur débloqué avec succès.');
    }

    public function storePlace(Request $request)
    {
        $request->validate([
            'numero' => 'required|string|max:10|unique:places,numero', // Changé
        ]);

        Place::create([
            'numero' => $request->numero, // Changé
        ]);
        return redirect()->route('admin.places')
            ->with('success', 'Place de parking créée avec succès');
    }

    public function updatePlace(Request $request, $id)
    {
        $request->validate([
            'numero' => 'required|string|max:10|unique:places,numero,' . $id . ',id_place', // Changé
        ]);

        $place = Place::findOrFail($id);
        $place->update([
            'numero' => $request->numero, // Changé
        ]);
        return redirect()->route('admin.places')
            ->with('success', 'Place de parking mise à jour avec succès');
    }

    public function destroyPlace($id)
    {
        try {
            $place = Place::findOrFail($id);
            $place->delete();
            return redirect()->route('admin.places')
                ->with('success', 'Place de parking supprimée avec succès');
        } catch (\Exception $e) {
            return redirect()->route('admin.places')
                ->with('error', 'Impossible de supprimer cette place');
        }
    }

}
