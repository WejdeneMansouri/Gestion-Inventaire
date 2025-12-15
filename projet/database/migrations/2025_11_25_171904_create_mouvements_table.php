<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('mouvements', function (Blueprint $table) {
            $table->id();

            // Produit concerné
            $table->foreignId('produit_id')
                  ->constrained('produits')
                  ->onDelete('cascade');

            // Qui a fait le mouvement (admin ou employé)
           $table->unsignedBigInteger('user_id')->nullable();

           
            // Type : entrée ou sortie
            $table->enum('type', ['entree', 'sortie']);

            // Quantité ajoutée ou retirée
            $table->integer('quantite');

            // Description optionnelle
            $table->text('description')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('mouvements');
    }
};
