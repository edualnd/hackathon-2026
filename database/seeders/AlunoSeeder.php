<?php

namespace Database\Seeders;

use App\Models\Aluno;
use App\Models\ListaEspera;
use App\Models\Vaga;
use Illuminate\Database\Seeder;

/**
 * Alunos de demonstração, cobrindo os cenários de vaga conseguida
 * e fila de espera, para que o dashboard e as listagens do painel
 * administrativo tenham dados reais para exibir.
 */
class AlunoSeeder extends Seeder
{
    public function run(): void
    {
        $registros = [
            [
                'nome' => 'Dario Victor Conceição Soares',
                'serie' => '1º Ano',
                'sexo' => 'M',
                'nascimento' => '2019-04-11',
                'responsavel' => 'Marta Conceição Soares',
                'parentesco' => 'Mãe',
                'telefone' => '(12) 99115-1143',
                'bairro' => 'Centro',
                'criterios' => ['area_de_abrangencia' => true, 'vulnerabilidade' => true],
            ],
            [
                'nome' => 'Pérola Gabrielle Nunes de Ara',
                'serie' => 'B2',
                'sexo' => 'F',
                'nascimento' => '2021-08-02',
                'responsavel' => 'Josiane Nunes de Ara',
                'parentesco' => 'Mãe',
                'telefone' => '(12) 91568-584',
                'bairro' => 'Jardim Primavera',
                'criterios' => ['area_de_abrangencia' => true],
            ],
            [
                'nome' => 'Noah Grégori Pereira',
                'serie' => '6º Ano',
                'sexo' => 'M',
                'nascimento' => '2014-01-20',
                'responsavel' => 'Camila Pereira',
                'parentesco' => 'Mãe',
                'telefone' => '(12) 98822-6479',
                'bairro' => 'Indaiá',
                'criterios' => ['mobilidade' => true, 'necessidade_especial' => true],
            ],
            [
                'nome' => 'Miguell Davi Ferreira da Silva',
                'serie' => '2ª Série',
                'sexo' => 'M',
                'nascimento' => '2010-11-30',
                'responsavel' => 'Renata Ferreira da Silva',
                'parentesco' => 'Mãe',
                'telefone' => '(12) 98154-7776',
                'bairro' => 'Massaguaçu',
                'criterios' => ['irmao' => true],
            ],
            [
                'nome' => 'Sophia Lopes Rodrigues',
                'serie' => '1º Ano',
                'sexo' => 'F',
                'nascimento' => '2019-06-15',
                'responsavel' => 'Adriana Lopes Rodrigues',
                'parentesco' => 'Mãe',
                'telefone' => '(12) 99725-1697',
                'bairro' => 'Centro',
                'criterios' => [],
            ],
            [
                'nome' => 'Isabelle Guedes dos Santos',
                'serie' => 'B2',
                'sexo' => 'F',
                'nascimento' => '2021-03-09',
                'responsavel' => 'Fernanda Guedes dos Santos',
                'parentesco' => 'Mãe',
                'telefone' => '(12) 99216-5759',
                'bairro' => 'Jardim Primavera',
                'criterios' => ['vulnerabilidade' => true],
            ],
            [
                'nome' => 'Anthony Gael Arello Batista',
                'serie' => '1º Ano',
                'sexo' => 'M',
                'nascimento' => '2019-09-25',
                'responsavel' => 'Paulo Arello Batista',
                'parentesco' => 'Pai',
                'telefone' => '(12) 99684-3222',
                'bairro' => 'Pontal Santamarina',
                'criterios' => ['area_de_abrangencia' => true, 'irmao' => true],
            ],
            [
                'nome' => 'Mavie Cristina Bonafatti Bueno',
                'serie' => 'M1',
                'sexo' => 'F',
                'nascimento' => '2022-02-18',
                'responsavel' => 'Cristina Bonafatti Bueno',
                'parentesco' => 'Mãe',
                'telefone' => '(12) 98189-6802',
                'bairro' => 'Perequê-Mirim',
                'criterios' => ['matriculado' => true],
            ],
        ];

        foreach ($registros as $i => $dados) {
            $vaga = Vaga::whereHas('escola', fn ($q) => $q->where('bairro', $dados['bairro']))
                ->where('serie', $dados['serie'])
                ->first();

            $aluno = Aluno::create([
                'escola_id' => $vaga?->escola_id,
                'vaga_id' => $vaga?->id,
                'nome' => $dados['nome'],
                'ra' => $vaga ? sprintf('1258%02d%02d-%d', $i, rand(10, 99), rand(1, 9)) : null,
                'cpf' => null,
                'sexo' => $dados['sexo'],
                'data_nascimento' => $dados['nascimento'],
                'certidao_nascimento' => sprintf('1158%02d.01.55.%04d.1.%05d.%03d.%07d', $i, 2024 + ($i % 2), rand(100, 999), rand(1, 9), rand(1000000, 9999999)),
                'nome_responsavel' => $dados['responsavel'],
                'cpf_responsavel' => sprintf('%03d.%03d.%03d-%02d', rand(100, 999), rand(100, 999), rand(100, 999), rand(10, 99)),
                'parentesco' => $dados['parentesco'],
                'telefone_pessoal' => $dados['telefone'],
                'telefone_recado' => null,
                'cep' => '11660-000',
                'uf' => 'SP',
                'municipio' => 'Caraguatatuba',
                'bairro' => $dados['bairro'],
                'logradouro' => 'Rua Exemplo',
                'numero' => (string) rand(10, 900),
                'observacao' => null,
            ]);

            $aluno->criterios()->create(array_merge([
                'area_de_abrangencia' => false,
                'mobilidade' => false,
                'irmao' => false,
                'vulnerabilidade' => false,
                'necessidade_especial' => false,
                'matriculado' => false,
            ], $dados['criterios']));

            if (! $vaga) {
                continue;
            }

            $posicao = (ListaEspera::where('vaga_id', $vaga->id)->max('posicao') ?? 0) + 1;

            ListaEspera::create([
                'aluno_id' => $aluno->id,
                'escola_id' => $vaga->escola_id,
                'vaga_id' => $vaga->id,
                'posicao' => $posicao,
                'pontuacao' => (string) (50 + collect($dados['criterios'])->filter()->count() * 10),
            ]);
        }
    }
}