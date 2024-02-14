<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Add user ID
            $table->string('payment_method'); // Payment method (e.g., credit card, PayPal)
            $table->timestamps();
        });

        Schema::create('payment_cart', function (Blueprint $table) {
            $table->id();
            $table->foreignId('payment_id')->constrained()->onDelete('cascade');
            $table->foreignId('cart_id')->constrained()->onDelete('cascade');
            $table->decimal('amount', 10, 2); // Add the amount column
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
        Schema::table('payment_cart', function (Blueprint $table) {
            $table->dropForeign(['payment_id']);
            $table->dropForeign(['cart_id']);
        });

        Schema::dropIfExists('payments');
        Schema::dropIfExists('payment_cart');
    }
}


