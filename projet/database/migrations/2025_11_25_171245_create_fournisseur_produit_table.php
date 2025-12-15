<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::create('fournisseur_produit', function (Blueprint $table) {
        $table->id();

        $table->foreignId('fournisseur_id')
              ->constrained('fournisseurs')
              ->onDelete('cascade');

        $table->foreignId('produit_id')
              ->constrained('produits')
              ->onDelete('cascade');

        $table->decimal('prix_achat', 10, 2)->default(0);

        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('fournisseur_produit');
}

};
