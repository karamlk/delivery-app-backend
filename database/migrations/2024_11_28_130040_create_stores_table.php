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
    Schema::create('stores', function (Blueprint $table) {
        $table->id();                // Unique ID for each store
        $table->string('name');       // Store name (e.g., Pizza Hut, Best Buy)
        $table->foreignId('category_id')  // Foreign key linking to categories table
              ->constrained()         // Automatically links to categories.id
              ->onDelete('cascade');  // If a category is deleted, delete stores too
        $table->timestamps();         // Created_at and updated_at columns
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stores');
    }
};
