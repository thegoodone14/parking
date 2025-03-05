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
            $table->id('id_reservation'); // Changé en minuscules
            $table->dateTime('date_heure_reservation'); // Changé en minuscules
            $table->dateTime('date_heure_expiration'); // Changé en minuscules
            $table->foreignId('id_place') // Changé en minuscules
                ->constrained('places', 'id_place');
            $table->foreignId('id_user') // Changé en minuscules
                ->constrained('users');
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
