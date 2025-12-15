<?php

namespace App\Http\Controllers;

use App\Models\Fournisseur;
use Illuminate\Http\Request;

class FournisseurController extends Controller
{
    public function index()
    {
        return Fournisseur::with('produits')->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'email' => 'nullable|email',
            'telephone' => 'nullable',
            'adresse' => 'nullable'
        ]);

        return Fournisseur::create($request->all());
    }

    public function show($id)
    {
        return Fournisseur::with('produits')->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $fournisseur = Fournisseur::findOrFail($id);
        $fournisseur->update($request->all());
        return $fournisseur;
    }

    public function destroy($id)
    {
        Fournisseur::destroy($id);
        return ['message' => 'Fournisseur supprimé'];
    }
}
