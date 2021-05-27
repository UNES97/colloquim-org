<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePreparticipationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preparticipations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_participant');
            $table->foreign('id_participant')->references('id')->on('participants')->onDelete('cascade');
            $table->string('year_participation');
            $table->string('type_participation');
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
        Schema::dropIfExists('preparticipations');
    }
}
