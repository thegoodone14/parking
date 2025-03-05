<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (auth()->user()->statut != 1) {
                abort(403, 'Accès non autorisé.');
            }
            return $next($request);
        });
    }

    public function index()
    {
        $users = User::withCount(['reservations' => function ($query) {
            $query->where('date_heure_expiration', '>', now()); // Changé
        }])->get();
        return view('admin.users', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'prenom' => 'required|string|max:255',
            'nom' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'statut' => 'required|boolean'
        ]);

        User::create([
            'prenom' => $request->prenom,
            'nom' => $request->nom,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'statut' => $request->statut,
        ]);

        return redirect()->route('admin.users')->with('success', 'Utilisateur créé avec succès.');
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $user = User::findOrFail($id);
            
            // Empêcher la suppression d'un admin
            if ($user->statut == 1) {
                return redirect()->route('admin.users')
                    ->with('error', 'Impossible de supprimer un administrateur.');
            }

            // Supprimer les réservations associées
            $user->reservations()->delete();
            
            // Supprimer l'utilisateur de la liste d'attente s'il y est
            $user->waitlistEntries()->delete();
            
            $user->delete();
            
            DB::commit();
            return redirect()->route('admin.users')
                ->with('success', 'Utilisateur supprimé avec succès.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('admin.users')
                ->with('error', 'Une erreur est survenue lors de la suppression.');
        }
    }

    public function toggleBlock($id)
    {
        $user = User::findOrFail($id);

        // Empêcher le blocage d'un admin
        if ($user->statut == 1) {
            return redirect()->route('admin.users')
                ->with('error', 'Impossible de bloquer un administrateur.');
        }

        DB::beginTransaction();
        try {
            $user->est_bloque = !$user->est_bloque;
            $user->save();

            // Si l'utilisateur est bloqué, annuler ses réservations actives
            if ($user->est_bloque) {
                $user->reservations()
                    ->where('Date_heure_expiration', '>', now())
                    ->delete();
                
                // Le retirer de la liste d'attente s'il y est
                $user->waitlistEntries()->delete();
            }

            DB::commit();
            return redirect()->route('admin.users')
                ->with('success', $user->est_bloque ? 'Utilisateur bloqué avec succès.' : 'Utilisateur débloqué avec succès.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('admin.users')
                ->with('error', 'Une erreur est survenue.');
        }
    }
}
