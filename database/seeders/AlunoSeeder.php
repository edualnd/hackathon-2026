<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AlunoSeeder extends Seeder
{
    public function run(): void
    {
        $nomes = [
            'Maria Silva', 'João Santos', 'Pedro Lima', 'Ana Paula',
            'Lucas Oliveira', 'Bruno Costa', 'Beatriz Souza', 'Gabriel Martins',
            'Larissa Almeida', 'Rafael Gomes', 'Eduardo Ribeiro', 'Camila Rocha',
            'Felipe Cardoso', 'Juliana Pereira', 'Matheus Ferreira', 'Isabela Rodrigues',
            'Gustavo Carvalho', 'Amanda Nunes', 'Thiago Barbosa', 'Bruna Azevedo',
            'Daniel Rocha', 'Carolina Dias', 'Vinicius Monteiro', 'Leticia Martins',
            'Leonardo Mendes', 'Bianca Farias', 'Henrique Teixeira', 'Sofia Lima',
            'Diego Gonçalves', 'Alice Moraes'
        ];

        $responsaveis = [
            'Ana Silva', 'Carlos Santos', 'Marcos Lima', 'Rita Paula',
            'Fernanda Oliveira', 'José Costa', 'Patrícia Souza', 'Roberto Martins',
            'Juliana Almeida', 'Mariana Gomes'
        ];

        $escolas = DB::table('escolas')->get();
        $vagas = DB::table('vagas')->get();

        for ($i = 1; $i <= 100; $i++) {

            $escola = $escolas->random();
            $vagasDaEscola = $vagas->where('escola_id', $escola->id)->values();

            if ($vagasDaEscola->isEmpty()) {
                continue;
            }

            $vaga = $vagasDaEscola->random();

            $alunoId = DB::table('alunos')->insertGetId([
                'escola_id' => $escola->id,
                'vaga_id' => $vaga->id,

                'nome' => $nomes[array_rand($nomes)] . ' ' . Str::random(2),
                'ra' => 'RA' . rand(1000, 9999),

                'cpf' => str_pad(rand(1, 99999999999), 11, '0', STR_PAD_LEFT),
                'sexo' => rand(0, 1) ? 'M' : 'F',

                'data_nascimento' => now()->subYears(rand(6, 14))->format('Y-m-d'),
                'certidao_nascimento' => 'CN' . rand(1000, 9999),

                'nome_responsavel' => $responsaveis[array_rand($responsaveis)],
                'cpf_responsavel' => str_pad(rand(1, 99999999999), 11, '0', STR_PAD_LEFT),
                'parentesco' => rand(0, 1) ? 'Mãe' : 'Pai',

                'telefone_pessoal' => '119' . rand(10000000, 99999999),
                'telefone_recado' => '113' . rand(1000000, 9999999),

                'cep' => '11660000',
                'uf' => 'SP',
                'municipio' => 'Caraguatatuba',
                'bairro' => $escola->bairro,
                'logradouro' => $escola->endereco,
                'numero' => rand(10, 999),

                'observacao' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::table('criterios')->insert([
                'aluno_id' => $alunoId,

                'area_de_abrangencia' => rand(0, 1),
                'mobilidade' => rand(0, 1),
                'irmao' => rand(0, 1),
                'vulnerabilidade' => rand(0, 1),
                'necessidade_especial' => rand(0, 1),
                'matriculado' => rand(0, 1),

                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}