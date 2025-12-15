<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Produit;
use App\Models\Fournisseur;
use App\Models\Mouvement;

/*
|--------------------------------------------------------------------------
| Auth routes (login / register)
|--------------------------------------------------------------------------
*/
Auth::routes();

/*
|--------------------------------------------------------------------------
| Routes protégées (Back-office)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */
    Route::get('/dashboard', function () {

        $totalProduits = Produit::count();
        $totalCategories = Category::count();
        $totalFournisseurs = Fournisseur::count();
        $stockTotal = Produit::sum('quantite');

        $entrees7 = Mouvement::where('type', 'entree')
            ->where('created_at', '>=', now()->subDays(7))
            ->sum('quantite');

        $sorties7 = Mouvement::where('type', 'sortie')
            ->where('created_at', '>=', now()->subDays(7))
            ->sum('quantite');

        $produitsRupture = Produit::where('quantite', '<=', 5)->get();

        $mouvementsToday = Mouvement::whereDate('created_at', today())->count();

        $chartData = [
            'labels' => [],
            'entrees' => [],
            'sorties' => [],
        ];

        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');

            $chartData['labels'][] = $date;
            $chartData['entrees'][] = Mouvement::where('type', 'entree')->whereDate('created_at', $date)->sum('quantite');
            $chartData['sorties'][] = Mouvement::where('type', 'sortie')->whereDate('created_at', $date)->sum('quantite');
        }

        return view('dashboard.index', compact(
            'totalProduits',
            'totalCategories',
            'totalFournisseurs',
            'stockTotal',
            'entrees7',
            'sorties7',
            'produitsRupture',
            'mouvementsToday',
            'chartData'
        ));
    });


    /*
    |--------------------------------------------------------------------------
    | Catégories
    |--------------------------------------------------------------------------
    */
    Route::get('/categories', function () {
        return view('categories.index', ['categories' => Category::all()]);
    });

    Route::get('/categories/create', function () {
        return view('categories.create');
    });

    Route::post('/categories', function (Request $request) {
        $request->validate(['nom' => 'required']);
        Category::create(['nom' => $request->nom]);
        return redirect('/categories')->with('success', 'Catégorie ajoutée');
    });


    /*
    |--------------------------------------------------------------------------
    | Produits
    |--------------------------------------------------------------------------
    */
    Route::get('/produits', function () {
        return view('produits.index', [
            'produits' => Produit::with('categorie')->get()
        ]);
    });

    Route::get('/produits/create', function () {
        return view('produits.create', ['categories' => Category::all()]);
    });

    Route::post('/produits', function (Request $request) {
        $request->validate([
            'nom' => 'required',
            'prix' => 'required|numeric',
            'quantite' => 'required|integer',
            'categorie_id' => 'required|exists:categories,id'
        ]);

        Produit::create($request->all());
        return redirect('/produits')->with('success', 'Produit ajouté');
    });

    Route::get('/produits/{id}/edit', function ($id) {
        return view('produits.edit', [
            'produit' => Produit::findOrFail($id),
            'categories' => Category::all()
        ]);
    });

    Route::put('/produits/{id}', function (Request $request, $id) {
        Produit::findOrFail($id)->update($request->all());
        return redirect('/produits')->with('success', 'Produit modifié');
    });

    Route::delete('/produits/{id}', function ($id) {
        Produit::destroy($id);
        return redirect('/produits')->with('success', 'Produit supprimé');
    });


    /*
    |--------------------------------------------------------------------------
    | Fournisseurs
    |--------------------------------------------------------------------------
    */
    Route::get('/fournisseurs', function () {
        return view('fournisseurs.index', ['fournisseurs' => Fournisseur::all()]);
    });

    Route::get('/fournisseurs/create', function () {
        return view('fournisseurs.create');
    });

    Route::post('/fournisseurs', function (Request $request) {
        Fournisseur::create($request->all());
        return redirect('/fournisseurs')->with('success', 'Fournisseur ajouté');
    });

    Route::get('/fournisseurs/{id}/edit', function ($id) {
        return view('fournisseurs.edit', [
            'fournisseur' => Fournisseur::findOrFail($id)
        ]);
    });

    Route::put('/fournisseurs/{id}', function (Request $request, $id) {
        Fournisseur::findOrFail($id)->update($request->all());
        return redirect('/fournisseurs')->with('success', 'Fournisseur modifié');
    });

    Route::delete('/fournisseurs/{id}', function ($id) {
        Fournisseur::destroy($id);
        return redirect('/fournisseurs')->with('success', 'Fournisseur supprimé');
    });


    /*
    |--------------------------------------------------------------------------
    | Mouvements (Entrées / Sorties)
    |--------------------------------------------------------------------------
    */
    Route::get('/mouvements', function () {
        return view('mouvements.index', [
            'mouvements' => Mouvement::with('produit')->latest()->get()
        ]);
    });

    Route::get('/mouvements/entree', function () {
        return view('mouvements.entree', ['produits' => Produit::all()]);
    });

    Route::get('/mouvements/sortie', function () {
        return view('mouvements.sortie', ['produits' => Produit::all()]);
    });

    Route::post('/mouvements', function (Request $request) {

        $produit = Produit::findOrFail($request->produit_id);

        if ($request->type === 'entree') {
            $produit->quantite += $request->quantite;
        } else {
            if ($produit->quantite < $request->quantite) {
                return back()->with('error', 'Stock insuffisant');
            }
            $produit->quantite -= $request->quantite;
        }

        $produit->save();

        Mouvement::create($request->all());

        return redirect('/mouvements')->with('success', 'Mouvement enregistré');
    });

});

/*
|--------------------------------------------------------------------------
| Redirection par défaut
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return redirect('/dashboard');
});
