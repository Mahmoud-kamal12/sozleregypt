<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEditionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('editions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
        });

        Schema::create('edition_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('edition_id')->unsigned();

            $table->string('locale')->index();
            $table->string('edition');

            $table->unique(['edition_id', 'locale']);
            $table->foreign('edition_id')->references('id')->on('editions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('editions');
        Schema::dropIfExists('edition_translations');
    }
}
