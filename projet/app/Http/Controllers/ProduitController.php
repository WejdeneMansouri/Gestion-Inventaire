<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use Illuminate\Http\Request;

class ProduitController extends Controller
{
    // Liste des produits
    public function index()
    {
        return Produit::with('categorie')->get();
    }

    // Ajouter un produit
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'prix' => 'required|numeric',
            'quantite' => 'required|integer',
            'categorie_id' => 'required|exists:categories,id'
        ]);

        $produit = Produit::create($request->all());

        return response()->json($produit, 201);
    }

    // Détails d’un produit
    public function show($id)
    {
        return Produit::with('categorie')->findOrFail($id);
    }

    // Modifier un produit
    public function update(Request $request, $id)
    {
        $produit = Produit::findOrFail($id);

        $request->validate([
            'nom' => 'required',
            'prix' => 'required|numeric',
            'quantite' => 'required|integer',
            'categorie_id' => 'required|exists:categories,id'
        ]);

        $produit->update($request->all());

        return response()->json($produit);
    }

    // Supprimer un produit
    public function destroy($id)
    {
        $produit = Produit::findOrFail($id);
        $produit->delete();

        return response()->json(['message' => 'Produit supprimé avec succès']);
    }
}
