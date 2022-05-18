<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('factures', function (Blueprint $table) {
            $table->increments('id');
            $table->string('client');
            $table->string('tel');
            $table->string('region');
            $table->string('ville');
            $table->string('adresse');
            $table->string('postal');
            $table->double('net');
            $table->double('promo');
            $table->double('total_ht');
            $table->date('date');
            $table->double('tva');
            $table->double('timbre');
            $table->double('total_ttc');
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
        Schema::drop('factures');
    }
}
