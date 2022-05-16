<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShippingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shippings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->double('cost');
            $table->timestamps();
        });

        Schema::create('shipping_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('shipping_id')->unsigned();

            $table->string('locale')->index();
            $table->string('city');

            $table->unique(['shipping_id', 'locale']);
            $table->foreign('shipping_id')->references('id')->on('shippings')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shippings');
    }
}
