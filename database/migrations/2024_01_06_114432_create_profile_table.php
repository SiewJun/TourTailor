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
        Schema::create('profile', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Add onDelete('cascade') here
            $table->string('avatar')->nullable(); // Store user avatars
            $table->string('phone')->nullable(); // Additional field for phone number
            $table->string('address')->nullable(); // Additional field for address
            $table->date('birthdate')->nullable(); // Additional field for birthdate
            $table->string('nric')->nullable(); // Additional field for NRIC
            // Add other fields as needed
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profile');
    }
};
