<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classifications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
        });

        Schema::create('classification_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('classification_id')->unsigned();

            $table->string('locale')->index();
            $table->string('classification');

            $table->unique(['classification_id', 'locale']);
            $table->foreign('classification_id')->references('id')->on('classifications')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('classifications');
        Schema::dropIfExists('classification_translations');
    }
}
