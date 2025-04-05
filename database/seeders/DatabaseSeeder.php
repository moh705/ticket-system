<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            PrioritySeeder::class,
            TicketStatusSeeder::class,
            TicketCategorySeeder::class,
            DepartmentSeeder::class,
            UserSeeder::class,
        ]);
    }
}