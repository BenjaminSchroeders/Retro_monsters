<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MonsterController;
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

Route::get('/', function () {
    return view('pages.home');
})->name('pages.home');

/* Routes Users */

Route::get('/createurs', function () {
    return view('users.index');
})->name('users.index');

Route::get('/users/{id}/{slug}', function (int $id) {
    return view('users.show', [
        'utilisateur' => \App\Models\User::find($id)
    ]);
})->name('users.show');

Route::get('/user/profile', function () {
    $userId = Auth::id(); // Récupère l'ID de l'utilisateur connecté
    $utilisateur = \App\Models\User::find($userId); // Récupère les données de l'utilisateur

    return view('users.profile', [
        'utilisateur' => $utilisateur
    ]);
})->name('users.profile');


Route::get('/user/deck', function () {
    $userId = Auth::id(); // Récupère l'ID de l'utilisateur connecté
    $utilisateur = \App\Models\User::find($userId);
    $monstresFavoris = $utilisateur->favorites; // Récupère les monstres favoris

    return view('users.deck', [
        'monstres' => $monstresFavoris
    ]);
})->name('users.deck');


/* Routes Monstres */

Route::get('/monstres', function () {
    return view('monstres.index');
})->name('monstres.index');


Route::get('/monstres/{id}/{slug}', function ($id) {
    $monstre = \App\Models\Monster::with('comments')->findOrFail($id);

    return view('monstres.show', ['monstre' => $monstre]);
})->name('monstres.show');

Route::get('/ajout', function () {
    return view('monstres.crud.ajout', [
        'rareties' => \App\Models\Raretie::all(),
        'types' => \App\Models\Monster_type::all()
    ]);
})->name('monstres.ajout');

Route::post('/ajout/add', [MonsterController::class, 'add'])->middleware('auth')->name('ajout.add');

Route::get('/liste', function () {
    $userId = Auth::id(); // Récupère l'ID de l'utilisateur connecté
    $monstres = \App\Models\Monster::where('user_id', $userId)->get(); // Récupère les monstres de cet utilisateur

    return view('monstres.crud.listePerso', ['monstres' => $monstres]);
})->name('liste.perso');

Route::get('/liste/edit/{id}', function ($id) {
    return view('monstres.crud.edit', [
        'rareties' => \App\Models\Raretie::all(),
        'types' => \App\Models\Monster_type::all(),
        'monstre' => \App\Models\Monster::findOrFail($id)
    ]);
})->name('liste.edit');


Route::put('/liste/edit/{id}', [MonsterController::class, 'edit'])->name('miseAJour');

Route::delete('/monstre/delete/{id}', [MonsterController::class, 'delete'])->name('liste.delete');

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
