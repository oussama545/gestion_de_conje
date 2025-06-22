<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name_fr' => 'Administrateur',
            'name_ar' => 'Administrator',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'), // Change this for security
            'role' => 'admin',
            'sexe' => 'homme',
            'date_naissance' => '1990-01-01',
            'cin' => 'AA123456',
            'date_recrutment' => '2020-01-01',
            'position' => 'Chef de projet',
            'affectation_detachement' => 'Direction Générale',
            'grade' => 'A',
            'service' => 'Informatique',
        ]);
    }
}
