<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TicketStatus;

class TicketStatusSeeder extends Seeder
{
    public function run()
    {
        TicketStatus::insert([
            ['name' => 'Open', 'description' => 'Le ticket est ouvert et en attente de traitement'],
            ['name' => 'In Progress', 'description' => 'Le ticket est en cours de traitement'],
            ['name' => 'Resolved', 'description' => 'Le ticket a été résolu'],
            ['name' => 'Closed', 'description' => 'Le ticket a été fermé'],
        ]);
    }
}