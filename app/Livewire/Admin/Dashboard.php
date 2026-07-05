<?php

namespace App\Livewire\Admin;

use App\Models\Aluno;
use App\Models\Escola;
use App\Models\ListaEspera;
use App\Models\Vaga;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.admin', ['pageTitle' => 'Dashboard'])]
class Dashboard extends Component
{
    public $totalVagas;
    public $totalListaEspera;
    public $totalMatriculados;
    public $recentes;

    public function carregarDados(){
        $escola = Auth::user()->escola_id ?? 'any';

        $this->totalVagas = $escola === 'any'
            ? Vaga::sum('qtd')
            : Vaga::where('escola_id', $escola)->sum('qtd');

        $this->totalListaEspera = $escola === 'any'
            ? ListaEspera::where('status', 'Aguardando')->count()
            : ListaEspera::where('escola_id', $escola)
                ->where('status', 'Aguardando')
                ->count();

        $this->totalMatriculados = $escola === 'any'
            ? ListaEspera::where('status', 'Matriculado')->count()
            : ListaEspera::where('escola_id', $escola)
                ->where('status', 'Matriculado')
                ->count();

        $this->recentes = $escola === 'any'
            ? ListaEspera::with(['aluno.escola', 'vaga'])
                ->latest('created_at')
                ->limit(6)
                ->get()
            : ListaEspera::where('escola_id', $escola)
                ->with(['aluno.escola', 'vaga'])
                ->latest('created_at')
                ->limit(6)
                ->get();
                
            
            }
    public function render()
    {
        $this->carregarDados();
        return view('livewire.admin.dashboard');
    }
}
