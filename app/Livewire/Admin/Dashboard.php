<?php

namespace App\Livewire\Admin;

use App\Models\Aluno;
use App\Models\Escola;
use App\Models\ListaEspera;
use App\Models\Vaga;
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
        $this->totalVagas = Vaga::where('escola_id', 1)->count();
        $this->totalListaEspera = ListaEspera::where('escola_id', 1)->where('status', "Aguardando")->count();
        $this->totalMatriculados = ListaEspera::where('escola_id',1)
        ->where('status', 'Matriculado')
        ->count();
        $this->recentes = ListaEspera::where('escola_id', 1)
        ->with(['aluno.escola', 'vaga'])
        ->latest()
        ->take(6)
        ->get()
        ->toArray();
        
        
    }
    public function render()
    {
        $this->carregarDados();
        return view('livewire.admin.dashboard');
    }
}
