<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProduitDevisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produit_devis', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_devis');
            $table->string('nom_produit');
            $table->integer('qty');
            $table->double('prix');
            $table->double('total');
            $table->string('taille');
            $table->integer('id_produit');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('produit_devis');
    }
}
