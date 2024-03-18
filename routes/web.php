<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/menu-administrateur',function (){
    return 'admin';

});

Route::get('/menu-administrateur/utilisateurs',function (){
    return 'liste utilisateurs';

});

Route::get('/menu-administrateur/places',function (){
    return 'les places';

});

Route::get('/menu-administrateur/historique-place',function (){
    return 'historique des places';

});

Route::get('/menu-administrateur/liste-attente-utilisateurs',function (){
    return 'liste d attente';

});

route::get('/menu-utilisateur', function (){
    return 'Bonjour';
});

route::get('/menu-utilisateur/reservation-en-cours', function (){
    return 'Bonjour';
});

route::get('/menu-utilisateur/nouvelle-reservation', function (){
    return 'Bonjour';
});

route::get('/menu-utilisateur/liste-attente', function (){
    return 'Bonjour';
});

route::get('/menu-utilisateur/parametre', function (){
    return 'Bonjour';
});
