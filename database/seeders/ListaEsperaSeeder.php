<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ListaEsperaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $alunos = DB::table('alunos')->get();

foreach ($alunos as $aluno) {

    DB::table('lista_espera')->insert([
        'aluno_id' => $aluno->id,
        'escola_id' => $aluno->escola_id,
        'vaga_id' => $aluno->vaga_id,

        'posicao' => rand(0, 20), // ou ordena depois se quiser
        'pontuacao' => rand(600, 1000) / 10,

        'data_chamada' => null,

        'status' => collect(['Aguardando', 'Matriculado', 'Foi chamado', "Desistencia"])
            ->random(),

        'created_at' => now(),
        'updated_at' => now(),
    ]);
}
    }
}
