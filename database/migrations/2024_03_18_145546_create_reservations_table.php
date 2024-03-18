<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id('ID_reservation');
            $table->dateTime('Date_heure_reservation');
            $table->dateTime('Date_heure_expiration');
            $table->foreignId('ID_Place')->constrained('places', 'ID_Place'); // Assurez-vous que la clé étrangère correspond au nom et type de votre clé primaire de la table `places`
            $table->foreignId('ID_user')->constrained('users'); // Assurez-vous que la clé étrangère correspond au nom et type de votre clé primaire de la table `users`
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservations');
    }
}
