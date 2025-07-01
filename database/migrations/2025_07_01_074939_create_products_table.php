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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->decimal('price', 10, 2);
            $table->decimal('originalPrice', 10, 2)->nullable();
            $table->decimal('discount', 5, 2)->nullable();
            $table->string('title')->unique();
            $table->string('description');
            $table->string('imageUrl'); // URL to product image
            $table->string('brand')->nullable(); // Product brand
            $table->string('category')->nullable(); // Product category
            $table->string('type')->nullable(); // Product type
            $table->string('deals')->nullable(); // Deals or offers associated with the product
            //$table->boolean('liked')->default(false); // Product liked status

        });
        Schema::table('products', function (Blueprint $table) {
            $table->index(['title', 'category', 'brand']); // Index for faster search queries
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
