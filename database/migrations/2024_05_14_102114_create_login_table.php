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
        Schema::create('login', function (Blueprint $table) {
            $table->id('id_login'); // Customize the primary key column name
            $table->string('email', 100)->unique(); // Email should be unique to ensure no duplicate entries
            $table->string('password', 255); // Sufficient length to store hashed passwords
            $table->timestamps(); // Laravel automatically adds created_at and updated_at columns
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('login');
    }
};
