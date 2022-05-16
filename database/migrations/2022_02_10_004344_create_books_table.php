<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('slug')->unique();

            $table->integer('number_pages');
            $table->integer('year_release');
            $table->string('size');
            $table->string('weight');
            $table->double('price_usd_after_discount');
            $table->double('price_le_after_discount');
            $table->string('ISBN');
            $table->string('code');



            $table->string('author');
            $table->string('publisher')->nullable();
            $table->string('translator');
            $table->string('investigator');

            $table->string('images' , 1000)->nullable();

            $table->unsignedBigInteger('edition_id');
            $table->unsignedBigInteger('classification_id');

            $table->foreign('edition_id')->references('id')->on('editions')->onDelete('cascade');
            $table->foreign('classification_id')->references('id')->on('classifications')->onDelete('cascade');

            $table->timestamps();
        });

        Schema::create('book_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('book_id')->unsigned();
            $table->string('locale')->index();

            $table->string('name');
            $table->string('binding_type');
            $table->string('paper_type');
            $table->string('printing_colors');
            $table->text('about');

            $table->unique(['book_id', 'locale']);
            $table->foreign('book_id')->references('id')->on('books')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
        Schema::dropIfExists('book_translations');
    }
}
