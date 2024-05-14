<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id('id_admin');
            $table->string('Nom_Complet', 20);
            $table->string('Professionnalite', 20);
            $table->string('Bio', 100);
            $table->binary('ImageUrl'); // Utilisation du type binary pour BLOB
            $table->timestamps(); // Si vous souhaitez enregistrer également les timestamps created_at et updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admins');
    }
}

