<?php

namespace App\Livewire\ListaEspera;

use App\Models\ListaEspera;
use Livewire\Attributes\On;
use Livewire\Component;

class Show extends Component
{
    public $vagaId = '10';
    public $listaEspera = [];

    #[On('dispatchOpenModalLista')]
    public function openModal($vagaId){
        $this->listaEspera = ListaEspera::where('vaga_id', $vagaId)
        ->orderBy('posicao', 'asc')
        ->get()->toArray();
    }


    
    public function render()
    {
        
        return view('livewire.lista-espera.show');
    }
}
