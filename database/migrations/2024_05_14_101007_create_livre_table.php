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
        Schema::create('livre', function (Blueprint $table) {
            $table->id('id_livre');
            $table->string('titre');
            $table->string('description');
            $table->binary('ImageUrl');
            $table->binary('pdf_uploaded');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('livre');
    }
};
