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
        'nome' => 'CIEFI PROF.ª ADOLFINA LEONOR SOARES DOS SANTOS',
        'telefone' => '3881-2521 / 3882-5195',
        'email' => 'emefadolfinacaraguatatuba@gmail.com',
        'tipo' => 'CIEFI',
        'regiao' => 'CENTRO-NORTE',
        'bairro' => 'Sumaré',
        'endereco' => 'Av. Siqueira Campos, 1257',
        'integral' => 1,
        'lat' => -23.61860000,
        'lng' => -45.41370000,
    ],
    [
        'nome' => 'CEI/EMEI ADI ADRIANA APARECIDA CASSIANO',
        'telefone' => '3887-1449',
        'email' => 'cei.adrianacassiano@gmail.com',
        'tipo' => 'CEI/EMEI',
        'regiao' => 'SUL',
        'bairro' => 'Perequê Mirim',
        'endereco' => 'Rua São Roque, 410',
        'integral' => 0,
        'lat' => -23.62657400,
        'lng' => -45.42220400,
    ],
    [
        'nome' => 'EMEI/EMEF PROF.ª AIDA DE ALMEIDA CASTRO GRAZIOLI',
        'telefone' => '3882-2610',
        'email' => 'emefgraziolicaraguatatuba@gmail.com',
        'tipo' => 'EMEI/EMEF',
        'regiao' => 'CENTRAL',
        'bairro' => 'Rio do Ouro',
        'endereco' => 'Rua Francisco Ribeiro, 80',
        'integral' => 0,
        'lat' => -23.61286000,
        'lng' => -45.42326000,
    ],
    [
        'nome' => 'EMEI/EMEF PROF.ª ALAOR XAVIER JUNQUEIRA',
        'telefone' => '3887-2612',
        'email' => 'emefjunqueiracaraguatatuba@gmail.com',
        'tipo' => 'EMEI/EMEF',
        'regiao' => 'SUL',
        'bairro' => 'Travessão',
        'endereco' => 'Rua José Ferreira dos Santos, 381',
        'integral' => 0,
        'lat' => -23.69798137,
        'lng' => -45.44442893,
    ],
    [
        'nome' => 'CEI/EMEI PROF.ª ANA MARIA AULICINO',
        'telefone' => '3883-1617',
        'email' => 'ceicalifornia2023@gmail.com',
        'tipo' => 'CEI/EMEI',
        'regiao' => 'CENTRAL',
        'bairro' => 'Jd. Califórnia',
        'endereco' => 'Rua Manoel Amaral, 51',
        'integral' => 0,
        'lat' => -23.61767891,
        'lng' => -45.41720495,
    ],
    [
        'nome' => 'EMEF PROF.ª ANTONIA ANTUNES AROUCA',
        'telefone' => '3884-3900',
        'email' => 'emefaroucacaraguatatuba@gmail.com',
        'tipo' => 'EMEF',
        'regiao' => 'NORTE',
        'bairro' => 'Massaguaçu',
        'endereco' => 'Rua Itália Baffi Magni, 581',
        'integral' => 0,
        'lat' => -23.58083115,
        'lng' => -45.33337369,
    ],
    [
        'nome' => 'CIEFI PROF.ª ANTONIA RIBEIRO DA SILVA',
        'telefone' => '3882-2286',
        'email' => 'ciefiribeiro@gmail.com',
        'tipo' => 'CIEFI',
        'regiao' => 'CENTRAL',
        'bairro' => 'Jd. Califórnia',
        'endereco' => 'Rua Alcides Alves Pereira, 140',
        'integral' => 1,
        'lat' => -23.61801706,
        'lng' => -45.41752480,
    ],
    [
        'nome' => 'EMEF PROF. ANTONIO DE FREITAS AVELAR',
        'telefone' => '3882-6284',
        'email' => 'emefavelarcaraguatatuba@gmail.com',
        'tipo' => 'EMEF',
        'regiao' => 'CENTRAL',
        'bairro' => 'Estrela D’Alva',
        'endereco' => 'Rua João Marcelo, 302',
        'integral' => 0,
        'lat' => -23.62025708,
        'lng' => -45.42023225,
    ],
    [
        'nome' => 'CEI/EMEI PROF.ª APARECIDA MARIA PIRES DE MENESES',
        'telefone' => '3883-8988',
        'email' => 'crecheolaria@gmail.com',
        'tipo' => 'CEI/EMEI',
        'regiao' => 'CENTRO-NORTE',
        'bairro' => 'Olaria',
        'endereco' => 'Av. Marginal Ipiranga, 17',
        'integral' => 0,
        'lat' => -23.60849658,
        'lng' => -45.37531879,
    ],
    [
        'nome' => 'EMEF PROF. AURACY MANSANO',
        'telefone' => '3883-9523',
        'email' => 'emef.auracymansano@educacaocaraguatatuba.com.br',
        'tipo' => 'EMEF',
        'regiao' => 'NORTE',
        'bairro' => 'Jetuba',
        'endereco' => 'Rua Gabriel Fagundes da Rosa, 305',
        'integral' => 1,
        'lat' => -23.59757659,
        'lng' => -45.35487562,
    ],
    [
        'nome' => 'EMEI/EMEF BENEDITO INÁCIO SOARES',
        'telefone' => '3884-5815',
        'email' => 'emefsoarescaraguatatuba@gmail.com',
        'tipo' => 'EMEI/EMEF',
        'regiao' => 'NORTE',
        'bairro' => 'Massaguaçu',
        'endereco' => 'Av. Regina Margareth Passos, 400',
        'integral' => 0,
        'lat' => -23.58042095,
        'lng' => -45.33199613,
    ],
];

        foreach ($escolas as $dados) {
            $escola = Escola::create($dados);
        }
    }
}
