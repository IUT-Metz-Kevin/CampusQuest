<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Joueur démo',
            'email' => 'joueur@campus-quest.test',
            'password' => 'joueur1234',
        ]);
    }
}
