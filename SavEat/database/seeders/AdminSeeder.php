<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Enums\Role;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@correo.com'],
            [
                'name' => 'Admin',
                'surname' => 'User',
                'role' => Role::Admin->value,
                'password' => Hash::make('Qwerty1234!'),
            ]
        );
    }
}
