<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWaitlistTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('waitlist', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Référence à l'utilisateur
            $table->timestamp('created_at')->useCurrent(); // Horodatage pour l'ordre de la liste d'attente

            $table->foreign('user_id')->references('id')->on('users'); // Clé étrangère vers la table des utilisateurs
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('waitlist');
    }
}
