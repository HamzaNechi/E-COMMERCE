<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePackProduitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pack_produits', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_pack');
            $table->string('nom_produit');
            $table->string('code_produit');
            $table->integer('qty');
            $table->double('prix');
            $table->string('couleur');
            $table->string('session_id');
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
        Schema::drop('pack_produits');
    }
}
