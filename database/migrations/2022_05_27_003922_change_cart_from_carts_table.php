<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeCartFromCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('carts', function (Blueprint $table) {
            $table->string('notes')->nullable()->change();
        });

        Schema::table('transaction_details', function (Blueprint $table) {
            $table->string('notes')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('carts', function (Blueprint $table) {
            $table->string('notes')->change();
        });
        Schema::table('transaction_details', function (Blueprint $table) {
            $table->string('notes')->change();
        });
    }
}
