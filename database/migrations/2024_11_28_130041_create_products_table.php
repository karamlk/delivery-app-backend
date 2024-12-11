<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();               // Unique ID for each product
            $table->string('name');      // Product name (e.g., Pizza, Laptop)
            $table->decimal('price', 10, 2);  // Price of the product
            $table->text('description');      // Description of the product
            $table->foreignId('store_id')     // Foreign key linking to stores table
                  ->constrained()            // Automatically links to stores.id
                  ->onDelete('cascade');     // If a store is deleted, delete its products too
            $table->timestamps();          // Created_at and updated_at columns
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
