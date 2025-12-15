<?php

namespace App\Http\Controllers;

use App\Models\Mouvement;
use App\Models\Produit;
use Illuminate\Http\Request;

class MouvementController extends Controller
{
    public function index()
    {
        return Mouvement::with(['produit', 'user'])->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'produit_id' => 'required|exists:produits,id',
            'quantite' => 'required|integer|min:1',
            'type' => 'required|in:entree,sortie'
        ]);

        $produit = Produit::findOrFail($request->produit_id);

        // Mise à jour du stock
        if ($request->type == 'entree') {
            $produit->quantite += $request->quantite;
        } else {
            if ($produit->quantite < $request->quantite) {
                return response()->json(['error' => 'Stock insuffisant'], 400);
            }
            $produit->quantite -= $request->quantite;
        }

        $produit->save();

        // Enregister le mouvement
        $mvt = Mouvement::create([
            'produit_id' => $request->produit_id,
            'quantite' => $request->quantite,
            'type' => $request->type,
            'user_id' => auth()->id(),
            'description' => $request->description
        ]);

        return response()->json($mvt, 201);
    }
}
