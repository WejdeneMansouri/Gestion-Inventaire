<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fournisseur extends Model
{
    protected $fillable = ['nom', 'email', 'telephone', 'adresse'];

    public function produits()
    {
        return $this->belongsToMany(Produit::class, 'fournisseur_produit')
                    ->withPivot('prix_achat')
                    ->withTimestamps();
    }
}
