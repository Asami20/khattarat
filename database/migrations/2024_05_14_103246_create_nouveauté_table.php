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
        Schema::create('nouveauté', function (Blueprint $table) {
            $table->id('id_nouveante');
            $table->binary('ImageUrl');
            $table->string('nom_région');
            $table->string('bénévole');
            $table->string('guide');
            $table->string('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
