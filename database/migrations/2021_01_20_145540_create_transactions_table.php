<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('uuid');
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone_number');
            $table->text('address');
            $table->bigInteger('transaction_total');
            $table->bigInteger('shipping_cost');
            $table->string('transaction_status');
            $table->string('courier');
            $table->string('payment');
            $table->string('receipt_number')->nullable();
            $table->string('proof_of_payment')->nullable();
            $table->integer('user_id');
            $table->softDeletes();
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
        Schema::dropIfExists('transactions');
    }
}
