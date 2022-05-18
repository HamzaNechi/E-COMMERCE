<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProduitFacturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produit_factures', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_facture');
            $table->integer('id_produit');
            $table->string('designation');
            $table->double('prix_venteHT');
            $table->integer('qty');
            $table->double('montant_ttc');
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
        Schema::drop('produit_factures');
    }
}
