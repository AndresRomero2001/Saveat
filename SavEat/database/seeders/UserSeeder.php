<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Enums\Role;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'user@correo.com'],
            [
                'name' => 'User',
                'surname' => 'User',
                'role' => Role::User->value,
                'password' => Hash::make('Qwerty1234!'),
            ]
        );
    }
}
