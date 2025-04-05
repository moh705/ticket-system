<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // Ajoutez cette ligne

class PrioritySeeder extends Seeder
{
    public function run()
    {
        // Vider la table avant de remplir avec de nouvelles données
        DB::table('priorities')->truncate();

        // Insérer les nouvelles données
        DB::table('priorities')->insert([
            ['color' => '#00FF00', 'level' => 1, 'name' => 'Faible'],
            ['color' => '#FFFF00', 'level' => 2, 'name' => 'Moyenne'],
            ['color' => '#FFA500', 'level' => 3, 'name' => 'Élevée'],
            ['color' => '#FF0000', 'level' => 4, 'name' => 'Critique'],
        ]);
    }
}