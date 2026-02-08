<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->unique();
            $table->unsignedBigInteger('user_id')->nullable();
            
            // Payment & Status
            $table->decimal('subtotal', 10, 2);
            $table->decimal('total_amount', 10, 2);
            $table->string('payment_method')->default('COD');
            $table->string('payment_status')->default('pending');
            $table->string('transaction_id')->nullable();
            $table->string('status')->default('pending'); // processing, shipped, delivered, cancelled

            // Shipping
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('phone');
            $table->text('address');
            $table->string('city');
            $table->string('state')->nullable();
            $table->string('zip_code');
            $table->string('country')->default('India');
            $table->text('notes')->nullable();

            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });

        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('variant_id')->nullable(); // Can be null if simple product
            
            $table->integer('quantity');
            $table->decimal('price', 10, 2);
            $table->decimal('total', 10, 2);
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('order_items');
        Schema::dropIfExists('orders');
    }
};
