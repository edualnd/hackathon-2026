<?php

namespace App\Livewire;
use App\Models\Vaga;
use App\Models\ListaEspera;
use Livewire\Component;

class SwitchExibicao extends Component
{   
    public $escolas;
    public $regiao;
    public $bairro;
    public $tipo;
    public $serie;
    

    public function mount($escolas = [], $regiao = "", $bairro = "", $tipo = "", $serie = "")
    {
        $this->escolas = $escolas;
        $this->regiao = $regiao;
        $this->bairro = $bairro;
        $this->tipo = $tipo;
        $this->serie = $serie;


    }


    public $exibicao = 'lista';

    public function switchLista(){
        $this->exibicao = 'lista'; 
        $this->dispatch('DispatchFecharnMapa');
    }
    
    public function switchMapa(){
        $this->exibicao = 'mapa';
        $this->dispatch('DispatchOpenMapa');
    }

    public function render()
    {
        return view('livewire.switch-exibicao');
    }
}
