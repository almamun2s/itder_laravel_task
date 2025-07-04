<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('mobile');
            $table->string('address');
            $table->json('products');
            $table->string('order_number', 15)->unique();
            $table->decimal('total_amount', 10, 2);


            $table->unsignedBigInteger('user_id')->nullable();
            $table->enum('status', ['pending', 'processing', 'completed', 'canceled'])->default('pending')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
