<?php

namespace App\Service;

use App\Models\ListaEspera;

class ListaEsperaService
{
    public function classificar(int $vagaId): void
    {
        $lista = ListaEspera::where('vaga_id', $vagaId)
            ->whereNotIn('status', ['Matriculado', 'Desistencia'])
            ->orderByDesc('pontuacao')
            ->orderBy('created_at')
            ->get();

        $posicao = 1;

        foreach ($lista as $item) {
            $item->update([
                'posicao' => $posicao
            ]);

            $posicao++;
        }

        ListaEspera::where('vaga_id', $vagaId)
            ->whereIn('status', ['Matriculado', 'Desistencia'])
            ->update([
                'posicao' => 0
            ]);
    }
}