<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Monster; // Assure-toi d'utiliser ton modèle Monster

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $searchText = $request->input('texte');

        // Recherche les monstres en fonction du texte
        $monstres = Monster::where('name', 'LIKE', "%{$searchText}%")
                           ->orWhere('description', 'LIKE', "%{$searchText}%")
                           ->get();

        // Renvoie à une vue avec les résultats de la recherche
        return view('search.search-results', ['monstres' => $monstres]);
    }
}
