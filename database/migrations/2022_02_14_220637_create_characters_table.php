<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCharactersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('characters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('type' , ['Author' , 'Translator' , 'Investigator' , 'Publisher']);
            $table->timestamps();
        });

        Schema::create('character_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('character_id')->unsigned();

            $table->string('locale')->index();
            $table->string('name');

            $table->unique(['character_id', 'locale']);
            $table->foreign('character_id')->references('id')->on('characters')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('characters');
        Schema::dropIfExists('character_translations');
    }
}
