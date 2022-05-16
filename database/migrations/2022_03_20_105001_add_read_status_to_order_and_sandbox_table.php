<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddReadStatusToOrderAndSandboxTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function($table) {
            $table->timestamp('read_at')->nullable();
        });

        Schema::table('sandboxes', function($table) {
            $table->timestamp('read_at')->nullable();
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function($table) {
            $table->dropColumn('read_at');
        });

        Schema::table('sandboxes', function($table) {
            $table->dropColumn('read_at');
        });
    }
}
