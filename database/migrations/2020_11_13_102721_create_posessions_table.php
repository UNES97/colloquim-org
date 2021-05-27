<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePosessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posessions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_article');
            $table->foreign('id_article')->references('id')->on('articles')->onDelete('cascade');
            $table->unsignedBigInteger('id_auteur');
            $table->foreign('id_auteur')->references('id')->on('auteurs')->onDelete('cascade');
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
        Schema::dropIfExists('posessions');
    }
}
