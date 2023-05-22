<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transaction_reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('users_id');
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('payment_id');

            // Foreign
            $table->foreign('users_id')
                ->references('id')
                ->on('users');

            $table->foreign('order_id')
                ->references('id')
                ->on('shopping_orders');

            $table->foreign('product_id')
                ->references('id')
                ->on('products');

            $table->foreign('payment_id')
                ->references('id')
                ->on('payments');

            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_reports');
    }
};
