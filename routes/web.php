<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MonsterController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/* Page d'Acceuil  */

Route::get('/', function () {
    return view('pages.home');
})->name('pages.home');

/* -------------------- Routes Users---------------------- */

/* Route index users  */
Route::get('/createurs', function () {
    return view('users.index');
})->name('users.index');

/* Route détail users  */
Route::get('/users/{id}/{slug}', function (int $id) {
    return view('users.show', [
        'utilisateur' => \App\Models\User::find($id)
    ]);
})->name('users.show');

/* Route profif users  */
Route::get('/user/profile', function () {
    $userId = Auth::id(); // Récupère l'ID de l'utilisateur connecté
    $utilisateur = \App\Models\User::find($userId); // Récupère les données de l'utilisateur

    return view('users.profile', [
        'utilisateur' => $utilisateur
    ]);
})->name('users.profile');

/* Route deck d'un users  */
Route::get('/user/deck', function () {
    $userId = Auth::id(); // Récupère l'ID de l'utilisateur connecté
    $utilisateur = \App\Models\User::find($userId);
    $monstresFavoris = $utilisateur->favorites; // Récupère les monstres favoris

    return view('users.deck', [
        'monstres' => $monstresFavoris
    ]);
})->name('users.deck');


/* -------------------- Routes Monstres---------------------- */

/* Route index monstres  */
Route::get('/monstres', function () {
    return view('monstres.index');
})->name('monstres.index');

/* Route détail monstre  */
Route::get('/monstres/{id}/{slug}', function ($id) {
    $monstre = \App\Models\Monster::with('comments')->findOrFail($id);

    return view('monstres.show', ['monstre' => $monstre]);
})->name('monstres.show');

/* Route formulaire ajout d'un monstre  */
Route::get('/ajout', function () {
    return view('monstres.crud.ajout', [
        'rareties' => \App\Models\Raretie::all(),
        'types' => \App\Models\Monster_type::all()
    ]);
})->name('monstres.ajout');

/* Route ajout d'un monstre  */
Route::post('/ajout/add', [MonsterController::class, 'add'])->middleware('auth')->name('ajout.add');

/* Route index monstres d'un utilisateur  */
Route::get('/liste', function () {
    $userId = Auth::id(); // Récupère l'ID de l'utilisateur connecté
    $monstres = \App\Models\Monster::where('user_id', $userId)->get(); // Récupère les monstres de cet utilisateur

    return view('monstres.crud.listePerso', ['monstres' => $monstres]);
})->name('liste.perso');

/* Route formulaire Edit d'un monstres  */
Route::get('/liste/edit/{id}', function ($id) {
    return view('monstres.crud.edit', [
        'rareties' => \App\Models\Raretie::all(),
        'types' => \App\Models\Monster_type::all(),
        'monstre' => \App\Models\Monster::findOrFail($id)
    ]);
})->name('liste.edit');

/* Route Edit d'un monstre  */
Route::put('/liste/edit/{id}', [MonsterController::class, 'edit'])->name('miseAJour');

/* Route suppression d'un monstres  */
Route::delete('/monstre/delete/{id}', [MonsterController::class, 'delete'])->name('liste.delete');


/* -------------------- Barre de recherche---------------------- */

/* Route Recherche écrite  */
Route::get('/recherche-texte', [SearchController::class, 'search'])->name('search');

/* AUTRES */

Route::get('/dashboard', function () {
    return view('pages.home');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
