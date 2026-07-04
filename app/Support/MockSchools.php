<?php

namespace App\Support;

use Illuminate\Support\Collection;

/**
 * Fonte única de dados mockados de unidades escolares.
 *
 * Escopo deste hackathon é apenas frontend — não há integração com banco
 * de dados ou API. Esta classe centraliza os dados fake para que os
 * componentes Livewire (busca, mapa e dashboard administrativo) fiquem
 * consistentes entre si e não dupliquem o mesmo array em vários lugares.
 */
class MockSchools
{
    /**
     * @return Collection<int, array<string, mixed>>
     */
    public static function all(): Collection
    {
        return collect([
            [
                'id' => 1,
                'nome' => 'EMEF Professora Alzira Franco',
                'bairro' => 'Centro',
                'endereco' => 'Rua Rui Barbosa, 245 - Centro, Caraguatatuba - SP',
                'nivel' => 'Fundamental I',
                'series' => ['1º ano', '2º ano', '3º ano', '4º ano', '5º ano'],
                'vagas' => 12,
                'lista_espera' => 8,
                'lat' => -23.6218,
                'lng' => -45.4131,
            ],
            [
                'id' => 2,
                'nome' => 'EMEI Jardim das Flores',
                'bairro' => 'Jardim Primavera',
                'endereco' => 'Av. das Palmeiras, 88 - Jardim Primavera, Caraguatatuba - SP',
                'nivel' => 'Infantil',
                'series' => ['Berçário', 'Maternal', 'Pré I', 'Pré II'],
                'vagas' => 0,
                'lista_espera' => 23,
                'lat' => -23.6082,
                'lng' => -45.4227,
            ],
            [
                'id' => 3,
                'nome' => 'EMEF Indaiá',
                'bairro' => 'Indaiá',
                'endereco' => 'Rua dos Coqueiros, 512 - Indaiá, Caraguatatuba - SP',
                'nivel' => 'Fundamental II',
                'series' => ['6º ano', '7º ano', '8º ano', '9º ano'],
                'vagas' => 5,
                'lista_espera' => 14,
                'lat' => -23.6367,
                'lng' => -45.4032,
            ],
            [
                'id' => 4,
                'nome' => 'EE Massaguaçu',
                'bairro' => 'Massaguaçu',
                'endereco' => 'Rod. Rio-Santos, km 12 - Massaguaçu, Caraguatatuba - SP',
                'nivel' => 'Médio',
                'series' => ['1ª série', '2ª série', '3ª série'],
                'vagas' => 30,
                'lista_espera' => 2,
                'lat' => -23.5842,
                'lng' => -45.4517,
            ],
            [
                'id' => 5,
                'nome' => 'EMEF Pontal Santamarina',
                'bairro' => 'Pontal Santamarina',
                'endereco' => 'Rua das Gaivotas, 190 - Pontal Santamarina, Caraguatatuba - SP',
                'nivel' => 'Fundamental I',
                'series' => ['1º ano', '2º ano', '3º ano', '4º ano', '5º ano'],
                'vagas' => 18,
                'lista_espera' => 0,
                'lat' => -23.6520,
                'lng' => -45.3874,
            ],
            [
                'id' => 6,
                'nome' => 'EMEI Perequê-Mirim',
                'bairro' => 'Perequê-Mirim',
                'endereco' => 'Av. Perequê-Mirim, 340 - Perequê-Mirim, Caraguatatuba - SP',
                'nivel' => 'Infantil',
                'series' => ['Berçário', 'Maternal', 'Pré I', 'Pré II'],
                'vagas' => 7,
                'lista_espera' => 5,
                'lat' => -23.6693,
                'lng' => -45.3766,
            ],
            [
                'id' => 7,
                'nome' => 'EE Tabatinga',
                'bairro' => 'Tabatinga',
                'endereco' => 'Rua Tabatinga, 77 - Tabatinga, Caraguatatuba - SP',
                'nivel' => 'Fundamental II',
                'series' => ['6º ano', '7º ano', '8º ano', '9º ano'],
                'vagas' => 0,
                'lista_espera' => 31,
                'lat' => -23.6981,
                'lng' => -45.3527,
            ],
            [
                'id' => 8,
                'nome' => 'EMEF Sumaré',
                'bairro' => 'Sumaré',
                'endereco' => 'Rua Sumaré, 401 - Sumaré, Caraguatatuba - SP',
                'nivel' => 'Médio',
                'series' => ['1ª série', '2ª série', '3ª série'],
                'vagas' => 9,
                'lista_espera' => 6,
                'lat' => -23.6151,
                'lng' => -45.4310,
            ],
        ]);
    }

    public static function niveis(): array
    {
        return static::all()->pluck('nivel')->unique()->sort()->values()->all();
    }

    public static function bairros(): array
    {
        return static::all()->pluck('bairro')->unique()->sort()->values()->all();
    }

    public static function series(): array
    {
        return static::all()->pluck('series')->flatten()->unique()->values()->all();
    }

    /**
     * Filtra a lista mockada pelos critérios informados.
     * Qualquer filtro vazio ("") é ignorado.
     */
    public static function search(string $nivel = '', string $bairro = '', string $serie = ''): Collection
    {
        return static::all()->filter(function (array $escola) use ($nivel, $bairro, $serie) {
            if ($nivel !== '' && $escola['nivel'] !== $nivel) {
                return false;
            }

            if ($bairro !== '' && $escola['bairro'] !== $bairro) {
                return false;
            }

            if ($serie !== '' && ! in_array($serie, $escola['series'], true)) {
                return false;
            }

            return true;
        })->values();
    }

    /**
     * Totais usados nos cards do dashboard administrativo.
     */
    public static function totals(): array
    {
        $escolas = static::all();

        return [
            'total_vagas' => $escolas->sum('vagas'),
            'total_lista_espera' => $escolas->sum('lista_espera'),
            'total_escolas' => $escolas->count(),
            'escolas_com_vagas' => $escolas->where('vagas', '>', 0)->count(),
        ];
    }
}
