<?
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FournisseurController;
use App\Http\Controllers\MouvementController;

// Routes publiques
Route::get('categories', [CategoryController::class, 'index']);
Route::get('produits', [ProduitController::class, 'index']);

// Routes protégées
Route::middleware('auth:sanctum')->group(function () {

    Route::apiResource('categories', CategoryController::class)->except(['index']);
    Route::apiResource('produits', ProduitController::class)->except(['index']);
    Route::apiResource('fournisseurs', FournisseurController::class);
    Route::apiResource('mouvements', MouvementController::class);

});
