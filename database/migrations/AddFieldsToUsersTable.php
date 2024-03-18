<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('prenom')->after('email'); // ajoute le prénom après l'email
            $table->string('nom')->after('prenom'); // ajoute le nom après le prénom
            $table->string('statut')->default('actif')->after('password'); // ajoute le statut après le mot de passe
            $table->integer('rang_attente')->nullable()->after('statut'); // ajoute le rang d'attente après le statut
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['prenom', 'nom', 'statut', 'rang_attente']);
        });
    }
}
