<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Department;

class DepartmentSeeder extends Seeder
{
    public function run()
    {
        Department::insert([
            ['name' => 'Département IT', 'description' => 'Gestion des infrastructures informatiques'],
            ['name' => 'Département RH', 'description' => 'Gestion des ressources humaines'],
            ['name' => 'Département Marketing', 'description' => 'Gestion des campagnes marketing'],
        ]);
    }
}