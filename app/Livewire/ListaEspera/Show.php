<?php

namespace App\Livewire\ListaEspera;

use App\Models\ListaEspera;
use App\Models\Vaga;
use Livewire\Attributes\Layout;
use Livewire\Component;
#[Layout("layouts.admin")]
class Show extends Component
{

    public $vagaId = null;
    public $vaga = null;

    public $listaEspera = [];


    public function mount($vagaId)
    {
        $this->vagaId = $vagaId;

        $this->vaga = Vaga::with('escola')->findOrFail($vagaId);

        $this->listaEspera = ListaEspera::with('aluno')
            ->where('vaga_id', $vagaId)
            ->orderByRaw('CASE WHEN posicao = 0 THEN 1 ELSE 0 END')
            ->orderBy('posicao')
            ->get();
        
       
    }



    public function render()
    {
        return view('livewire.lista-espera.show');
    }
}