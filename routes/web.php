<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HistoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

// Routes pour les utilisateurs connectés
Route::middleware(['auth'])->group(function () {
    Route::get('/menu-utilisateur', function () {
        return view('menu_utilisateur');
    })->name('menu_utilisateur');

    Route::resource('reservations', ReservationController::class);
    Route::get('/reservations/create', [ReservationController::class, 'create'])->name('reservations.create');
    Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');

    Route::get('/menu-utilisateur/reservation-en-cours', function () {
        return view('reservation_en_cours');
    })->name('reservation.en.cours');

    Route::get('/menu-utilisateur/nouvelle-reservation', function () {
        return view('nouvelle_reservation');
    })->name('nouvelle.reservation');

    Route::get('/waitlist', [ReservationController::class, 'waitlist'])->name('waitlist');
    Route::get('/reservations/waitlist', [ReservationController::class, 'waitlist'])->name('reservations.waitlist');

    Route::get('/menu-utilisateur/parametre', function () {
        return view('parametre');
    })->name('parametre');
});

// Routes pour l'administration
Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::resource('places', PlaceController::class);
    
    Route::prefix('admin')->group(function () {
        // Places
        Route::post('/places', [AdminController::class, 'storePlace'])->name('admin.places.store');
        Route::put('/places/{id}', [AdminController::class, 'updatePlace'])->name('admin.places.update');
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');
        
        Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
        Route::patch('/users/{user}/toggle-block', [AdminController::class, 'toggleBlock'])->name('admin.users.toggleBlock');
        Route::get('/users/edit', [AdminController::class, 'edit'])->name('admin.users.edit');
        Route::get('/places', [AdminController::class, 'places'])->name('admin.places');
        Route::delete('/destroy', [AdminController::class, 'destroy'])->name('admin.users.destroy');
        Route::get('/history', [HistoryController::class, 'index'])->name('admin.history');
        Route::get('/waitlist', [AdminController::class, 'waitlist'])->name('admin.waitlist');
        Route::get('/places/edit', [AdminController::class, 'edit'])->name('admin.places.edit');
        Route::delete('/places/{ID_Place}', [AdminController::class, 'destroyPlace'])->name('admin.places.destroy');
        Route::delete('/waitlist/{id}', [AdminController::class, 'destroy'])->name('admin.waitlist.destroy');
    });
});