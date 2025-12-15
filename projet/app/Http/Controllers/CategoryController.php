<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Liste des catégories
    public function index()
    {
        return Category::all();
    }

    // Ajouter une catégorie
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|unique:categories'
        ]);

        $category = Category::create([
            'nom' => $request->nom
        ]);

        return response()->json($category, 201);
    }

    // Afficher 1 catégorie
    public function show($id)
    {
        return Category::findOrFail($id);
    }

    // Modifier une catégorie
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $request->validate([
            'nom' => 'required|unique:categories,nom,' . $id
        ]);

        $category->update(['nom' => $request->nom]);

        return response()->json($category);
    }

    // Supprimer une catégorie
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return response()->json(['message' => 'Catégorie supprimée']);
    }
}
