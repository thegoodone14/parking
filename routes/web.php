<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\ReservationController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

//Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::resource('places', PlaceController::class);

    Route::get('/menu-administrateur',function (){
        return 'admin';

    });

    Route::get('/menu-administrateur/utilisateurs',function (){
        return view('liste_utilisateurs');

    });

    Route::get('/menu-administrateur/places',function (){
        return View('les_places');

    });

    Route::get('/menu-administrateur/historique-place',function (){
        return view('historique_des_places');

    });

    Route::get('/menu-administrateur/liste-attente-utilisateurs',function (){
        return View('liste_d_attente');

    });



   // Route::middleware(['auth'])->group(function () {
        
        Route::resource('reservations', ReservationController::class);
        // Toutes les autres routes qui nécessitent une authentification

        route::get('/menu-utilisateur', function (){
            return View('menu_utilisateur');
        });

        route::get('/menu-utilisateur/reservation-en-cours', function (){
            return View('reservation_en_cours');

        });

        route::get('/menu-utilisateur/nouvelle-reservation', function (){
            return View('nouvelle_reservation');
            Route::get('/reservations/create', [ReservationController::class, 'create'])->name('reservations.create');
        });

        Route::get('/waitlist', [ReservationController::class, 'waitlist'])->name('waitlist');


        route::get('/menu-utilisateur/parametre', function (){
            return View('parametre');
    });
//});


//});