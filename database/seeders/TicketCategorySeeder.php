<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TicketCategory;

class TicketCategorySeeder extends Seeder
{
    public function run()
    {
        TicketCategory::insert([
            ['name' => 'Support Technique', 'description' => 'Problèmes liés au matériel ou logiciel'],
            ['name' => 'Demande de Service', 'description' => 'Demandes générales de service IT'],
            ['name' => 'Amélioration Système', 'description' => 'Suggestions pour améliorer le système'],
        ]);
    }
}