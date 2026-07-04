<?php

namespace Database\Seeders;

use App\Models\Escola;
use Illuminate\Database\Seeder;

/**
 * Unidades escolares da rede municipal de Caraguatatuba (dados de
 * demonstração) + suas vagas por série, usadas em todo o painel
 * administrativo (dashboard, mapa e formulário de cadastro de alunos).
 */
class EscolaSeeder extends Seeder
{
    public function run(): void
    {
        $escolas = [
            [
                'nome' => 'EMEF Professora Alzira Franco',
                'telefone' => '(12) 3882-1010',
                'email' => 'alzirafranco@educacaocaraguatatuba.sp.gov.br',
                'tipo' => 'Fundamental I',
                'regiao' => 'Litoral Sul',
                'bairro' => 'Centro',
                'endereco' => 'Rua Rui Barbosa, 245 - Centro, Caraguatatuba - SP',
                'integral' => false,
                'lat' => -23.6218,
                'lng' => -45.4131,
                'vagas' => ['1º Ano' => 8, '2º Ano' => 5, '3º Ano' => 0, '4º Ano' => 6, '5º Ano' => 4],
            ],
            [
                'nome' => 'EMEI Jardim das Flores',
                'telefone' => '(12) 3882-1022',
                'email' => 'jardimdasflores@educacaocaraguatatuba.sp.gov.br',
                'tipo' => 'Infantil',
                'regiao' => 'Litoral Sul',
                'bairro' => 'Jardim Primavera',
                'endereco' => 'Av. das Palmeiras, 88 - Jardim Primavera, Caraguatatuba - SP',
                'integral' => true,
                'lat' => -23.6082,
                'lng' => -45.4227,
                'vagas' => ['B1' => 0, 'B2' => 3, 'M1' => 0, 'M2' => 2],
            ],
            [
                'nome' => 'EMEF Indaiá',
                'telefone' => '(12) 3882-1033',
                'email' => 'indaia@educacaocaraguatatuba.sp.gov.br',
                'tipo' => 'Fundamental II',
                'regiao' => 'Litoral Norte',
                'bairro' => 'Indaiá',
                'endereco' => 'Rua dos Coqueiros, 512 - Indaiá, Caraguatatuba - SP',
                'integral' => false,
                'lat' => -23.6367,
                'lng' => -45.4032,
                'vagas' => ['6º Ano' => 4, '7º Ano' => 0, '8º Ano' => 3, '9º Ano' => 2],
            ],
            [
                'nome' => 'EE Massaguaçu',
                'telefone' => '(12) 3882-1044',
                'email' => 'massaguacu@educacaocaraguatatuba.sp.gov.br',
                'tipo' => 'Médio',
                'regiao' => 'Litoral Norte',
                'bairro' => 'Massaguaçu',
                'endereco' => 'Rod. Rio-Santos, km 12 - Massaguaçu, Caraguatatuba - SP',
                'integral' => false,
                'lat' => -23.5842,
                'lng' => -45.4517,
                'vagas' => ['1ª Série' => 12, '2ª Série' => 9, '3ª Série' => 5],
            ],
            [
                'nome' => 'EMEF Pontal Santamarina',
                'telefone' => '(12) 3882-1055',
                'email' => 'pontalsantamarina@educacaocaraguatatuba.sp.gov.br',
                'tipo' => 'Fundamental I',
                'regiao' => 'Litoral Sul',
                'bairro' => 'Pontal Santamarina',
                'endereco' => 'Rua das Gaivotas, 190 - Pontal Santamarina, Caraguatatuba - SP',
                'integral' => true,
                'lat' => -23.6520,
                'lng' => -45.3874,
                'vagas' => ['1º Ano' => 6, '2º Ano' => 7, '3º Ano' => 5, '4º Ano' => 8, '5º Ano' => 3],
            ],
            [
                'nome' => 'EMEI Perequê-Mirim',
                'telefone' => '(12) 3882-1066',
                'email' => 'pereque.mirim@educacaocaraguatatuba.sp.gov.br',
                'tipo' => 'Infantil',
                'regiao' => 'Litoral Sul',
                'bairro' => 'Perequê-Mirim',
                'endereco' => 'Av. Perequê-Mirim, 340 - Perequê-Mirim, Caraguatatuba - SP',
                'integral' => true,
                'lat' => -23.6693,
                'lng' => -45.3766,
                'vagas' => ['B1' => 2, 'B2' => 3, 'M1' => 2, 'M2' => 0],
            ],
        ];

        foreach ($escolas as $dados) {
            $vagas = $dados['vagas'];
            unset($dados['vagas']);

            $escola = Escola::create($dados);

            foreach ($vagas as $serie => $qtd) {
                $escola->vagas()->create([
                    'serie' => $serie,
                    'qtd' => $qtd,
                ]);
            }
        }
    }
}
