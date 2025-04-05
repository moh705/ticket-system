<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::insert([
            [
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => bcrypt('password'),
                'role' => 'admin',
                'department_id' => 1,
            ],
            [
                'name' => 'Technician User',
                'email' => 'technician@example.com',
                'password' => bcrypt('password'),
                'role' => 'technician',
                'department_id' => 1,
            ],
            [
                'name' => 'Employee User',
                'email' => 'employee@example.com',
                'password' => bcrypt('password'),
                'role' => 'employee',
                'department_id' => 2,
            ],
        ]);
    }
}