<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Compte Admin
        User::updateOrCreate(
            ['email' => 'admin@stock.com'],
            [
                'name' => 'Administrateur',
                'email' => 'admin@stock.com',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ]
        );
        $this->command->info('✅ Compte Admin créé : admin@stock.com / admin123');

        // Compte Superviseur
        User::updateOrCreate(
            ['email' => 'superviseur@stock.com'],
            [
                'name' => 'Superviseur',
                'email' => 'superviseur@stock.com',
                'password' => Hash::make('super123'),
                'role' => 'superviseur',
            ]
        );
        $this->command->info('✅ Compte Superviseur créé : superviseur@stock.com / super123');
    }
}
