<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sessions', function (Blueprint $table) {
            $table->id();
            $table->string('theme');
            $table->date('jour');
            $table->time('heure_debut');
            $table->time('heure_fin');
            $table->float('cout_inscription');
            $table->string('type_presentant');
            $table->unsignedBigInteger('id_auteur')->nullable();
            $table->foreign('id_auteur')->references('id')->on('auteurs')->onDelete('cascade');
            $table->unsignedBigInteger('id_expert')->nullable();
            $table->foreign('id_expert')->references('id')->on('experts')->onDelete('cascade');
            $table->unsignedBigInteger('id_participant')->nullable();
            $table->foreign('id_participant')->references('id')->on('participants')->onDelete('cascade');
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
        Schema::dropIfExists('sessions');
    }
}
