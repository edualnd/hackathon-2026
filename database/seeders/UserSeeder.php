<?php

namespace Database\Seeders;

use App\Models\User;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
   public function run(): void
    {
        User::create([
            'name' => 'Usuário Demanda',
            'email' => 'demanda@teste.com',
            'cpf' => '11111111111',
            'password' => Hash::make('123456'),
            'role' => 'demanda',
            'escola_id' => null
        ]);

        User::create([
            'name' => 'Usuário Administração',
            'email' => 'administracao@teste.com',
            'cpf' => '22222222222',
            'password' => Hash::make('123456'),
            'role' => 'administracao',
            'escola_id' => 1
        ]);
    }
}
