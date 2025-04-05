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
        Schema::table('users', function (Blueprint $table) {
            // Ajout de la colonne 'role' uniquement si elle n'existe pas déjà
            if (!Schema::hasColumn('users', 'role')) {
                $table->enum('role', ['employee', 'technician', 'admin'])
                      ->default('employee')
                      ->after('email');  // Placer après la colonne 'email'
            }

            // Ajout de la colonne 'department_id' uniquement si elle n'existe pas déjà
            if (!Schema::hasColumn('users', 'department_id')) {
                $table->foreignId('department_id')
                      ->nullable()
                      ->after('role')  // Placer après la colonne 'role'
                      ->constrained() // Contrainte de clé étrangère vers la table 'departments'
                      ->onDelete('set null'); // En cas de suppression d'un département, la valeur devient null
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Supprimer la colonne 'role' uniquement si elle existe
            if (Schema::hasColumn('users', 'role')) {
                $table->dropColumn('role');
            }

            // Supprimer la clé étrangère et la colonne 'department_id' uniquement si elles existent
            if (Schema::hasColumn('users', 'department_id')) {
                $table->dropForeign(['department_id']); // Supprimer la contrainte de clé étrangère
                $table->dropColumn('department_id');    // Supprimer la colonne
            }
        });
    }
};