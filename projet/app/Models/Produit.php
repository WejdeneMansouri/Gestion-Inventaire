<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    protected $fillable = [
        'nom',
        'description',
        'prix',
        'quantite',
        'categorie_id'
    ];

    public function categorie()
    {
        return $this->belongsTo(Category::class);
    }

    public function fournisseurs()
    {
        return $this->belongsToMany(Fournisseur::class, 'fournisseur_produit')
                    ->withPivot('prix_achat')
                    ->withTimestamps();
    }

    public function mouvements()
    {
        return $this->hasMany(Mouvement::class);
    }
}
