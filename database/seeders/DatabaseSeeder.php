<?php

namespace Database\Seeders;

use App\Service\ListaEsperaService;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
        EscolaSeeder::class,
        UserSeeder::class,
        VagaSeeder::class,
        AlunoSeeder::class,
        ListaEsperaSeeder::class,
    ]);

    $service = new ListaEsperaService();

    $vagas = DB::table('vagas')->get();

    foreach ($vagas as $vaga) {
        $service->classificar($vaga->id);
    }
    }
}
