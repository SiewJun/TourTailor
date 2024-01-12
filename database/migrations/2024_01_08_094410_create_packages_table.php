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
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained(); // Foreign key to relate the package to a user (admin or regular user)
            $table->string('title'); // Title of the travel package
            $table->text('description'); // Description of the travel package
            $table->decimal('price', 10, 2); // Price of the travel package
            $table->date('start_date'); // Start date of the travel package
            $table->date('end_date'); // End date of the travel package
            $table->string('location'); // Location of the travel package
            $table->boolean('featured')->default(false); // Indicates if the package is featured
            $table->string('cover_image')->nullable(); // URL or path to the cover image of the package
            // Add other fields as needed
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};
