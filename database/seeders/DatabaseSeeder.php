<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin; // Assurez-vous d'utiliser le bon namespace ici

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::create([
            'email' => 'adminKhettarat2024@gmail.com',
            'password' => Hash::make('Khettarat2024@')
        ]);
    }
}
