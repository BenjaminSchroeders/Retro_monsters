<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Monster;

use Illuminate\Http\Request;

class MonsterController extends Controller
{
    public function add(Request $request)
    {
        // Valider les données du formulaire
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'rarety' => 'required|exists:rareties,id', // Assure-toi que 'rarety' correspond au nom dans ta base de données
            'type' => 'required|exists:monster_types,id',
            'pv' => 'required|integer|min:0|max:200',
            'attack' => 'required|integer|min:0|max:200',
            'defense' => 'required|integer|min:0|max:200',
            'image_url' => 'image|mimes:jpeg,png,jpg,gif,svg', // Rendre l'image facultative
        ]);

        if ($request->hasFile('image_url')) {
            $originalName = str_replace(' ', '-', strtolower($request->name));
            $imageName = $originalName . '.' . $request->image_url->extension();
        
            // Déplacer le fichier téléchargé directement dans public/images
            $request->image_url->move(public_path('images'), $imageName);
        } else {
            $imageName = 'default.png';
        }

        // Créer un nouveau monstre
        $monster = new Monster;
        $monster->name = $validatedData['name'];
        $monster->description = $validatedData['description'];
        $monster->rarety_id = $validatedData['rarety']; // Assure-toi que cela correspond au nom dans ta base de données
        $monster->type_id = $validatedData['type'];
        $monster->pv = $validatedData['pv'];
        $monster->attack = $validatedData['attack'];
        $monster->defense = $validatedData['defense'];
        $monster->image_url = $imageName;
        $monster->user_id = auth()->id();

        // Enregistrer le monstre dans la base de données
        $monster->save();

        // Rediriger vers une page avec un message de succès
        return redirect()->route('pages.home');
    }

    public function edit(Request $request, $id)
{
    $monster = Monster::findOrFail($id); // Récupère le monstre ou renvoie une erreur 404 si non trouvé

    // Valider les données du formulaire
    $validatedData = $request->validate([
        'name' => 'required|max:255',
        'description' => 'required',
        'rarety' => 'required|exists:rareties,id',
        'type' => 'required|exists:monster_types,id',
        'pv' => 'required|integer|min:0|max:200',
        'attack' => 'required|integer|min:0|max:200',
        'defense' => 'required|integer|min:0|max:200',
        'image_url' => 'image|mimes:jpeg,png,jpg,gif,svg', // Rendre l'image facultative
    ]);

    // Gérer l'upload de l'image
    if ($request->hasFile('image_url')) {
        $originalName = str_replace(' ', '-', strtolower($request->name));
        $imageName = $originalName . '.' . $request->image_url->extension();
        $request->image_url->storeAs('public/images', $imageName);
        $monster->image_url = $imageName; // Mettre à jour l'image seulement si une nouvelle est téléchargée
    }

    // Mettre à jour le monstre existant
    $monster->name = $validatedData['name'];
    $monster->description = $validatedData['description'];
    $monster->rarety_id = $validatedData['rarety'];
    $monster->type_id = $validatedData['type'];
    $monster->pv = $validatedData['pv'];
    $monster->attack = $validatedData['attack'];
    $monster->defense = $validatedData['defense'];

    // Enregistrer les changements dans la base de données
    $monster->save();

    // Rediriger vers une page avec un message de succès
    return redirect()->route('liste.perso'); // Remplace 'pages.home' par la route où tu veux rediriger l'utilisateur
}

public function delete($id)
{
    $monster = Monster::findOrFail($id);
                $photoFileName = $monster->image_url; 
                
               \App\Models\Comment::where('monster_id', $id)->delete();
               \App\Models\Favorite::where('monster_id', $id)->delete();

               if (!empty($photoFileName) && $photoFileName !== 'default.png') {
                $photoPath = public_path('images/' . $photoFileName); // Assurez-vous que le chemin est correct.
                if (file_exists($photoPath)) {
                    unlink($photoPath);
                }
            }
    $monster->delete();

    

    return redirect()->route('liste.perso')->with('success', 'Monstre supprimé avec succès.');
}

public function toggleFavorite(Request $request)
{
    $monster = Monster::findOrFail($request->monster_id);
    $user = auth()->user();

    if ($user->favoriteMonsters()->where('monster_id', $monster->id)->exists()) {
        $user->favoriteMonsters()->detach($monster->id);
        return response()->json(['isFavorited' => false]);
    } else {
        $user->favoriteMonsters()->attach($monster->id);
        return response()->json(['isFavorited' => true]);
    }
}



}
