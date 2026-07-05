<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VagaSeeder extends Seeder
{
    public function run(): void
    {
        $seriesFundamental1 = ['1º Ano', '2º Ano', '3º Ano', '4º Ano', '5º Ano'];
        $seriesFundamental2 = ['6º Ano', '7º Ano', '8º Ano', '9º Ano'];
        $seriesBercario = ['B1', 'B2', 'M1', 'M2'];

        $escolas = DB::table('escolas')->get();

        foreach ($escolas as $escola) {

            $tipo = $escola->tipo;
            $series = [];

            if ($tipo === 'CIEFI') {
                $series = array_slice($seriesFundamental1, 0, 3);
            }

            if ($tipo === 'EMEI/EMEF') {
                $series = array_slice($seriesFundamental1, 0, 3);
            }

            if ($tipo === 'CEI/EMEI') {
                $series = rand(0, 1)
                    ? array_slice($seriesFundamental1, 0, 3)
                    : array_slice($seriesBercario, 0, 3);
            }

            if ($tipo === 'EMEF') {
                $series = array_slice($seriesFundamental2, 0, 3);
            }

            foreach ($series as $serie) {
                DB::table('vagas')->insert([
                    'escola_id' => $escola->id,
                    'serie' => $serie,
                    'qtd' => rand(20, 35),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}