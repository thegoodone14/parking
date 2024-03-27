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


/*Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');*/


require __DIR__.'/auth.php';
Route::get('/menu_utilisateur', function () {
    return view('menu_utilisateur')
})->middleware(['auth'])->name('menu_utilisateur');


Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::resource('places', PlaceController::class);
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
    Route::get('/admin/places', [AdminController::class, 'places'])->name('admin.places');
    Route::get('/admin/places/history', [AdminController::class, 'placesHistory'])->name('admin.places.history');
    Route::get('/admin/waitlist', [AdminController::class, 'waitlist'])->name('admin.waitlist');
});

   



   // Route::middleware(['auth'])->group(function () {
        
    Route::get('/reservations/create', [ReservationController::class, 'create'])->name('reservations.create');

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
        });

        Route::get('/waitlist', [ReservationController::class, 'waitlist'])->name('waitlist');
        Route::get('/reservations/waitlist', [ReservationController::class, 'waitlist'])->name('reservations.waitlist');


        route::get('/menu-utilisateur/parametre', function (){
            return View('parametre');
    });
//});


//});