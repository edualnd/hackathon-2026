<?php

namespace App\Livewire\Admin;

use App\Models\Aluno;
use App\Models\Escola;
use App\Models\Vaga;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        $totalVagas = Vaga::sum('qtd');
        $totalListaEspera = Aluno::where('status', Aluno::STATUS_FILA_ESPERA)->count();
        $totalEscolas = Escola::count();
        $totalMatriculados = Aluno::where('status', Aluno::STATUS_VAGA_CONSEGUIDA)->count();

        $escolasComVagas = Vaga::query()
            ->select('escola_id')
            ->where('qtd', '>', 0)
            ->distinct()
            ->count('escola_id');

        $recentes = Aluno::with(['escola', 'vaga'])
            ->latest()
            ->take(6)
            ->get();

        return view('livewire.admin.dashboard', [
            'totalVagas' => $totalVagas,
            'totalListaEspera' => $totalListaEspera,
            'totalEscolas' => $totalEscolas,
            'totalMatriculados' => $totalMatriculados,
            'escolasComVagas' => $escolasComVagas,
            'recentes' => $recentes,
        ])->layout('layouts.admin', ['pageTitle' => 'Dashboard']);
    }
}
